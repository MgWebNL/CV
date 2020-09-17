<?php

namespace PenD\Docker\Console;

use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application AS BaseApplication;
use Symfony\Component\Console\Command\Command as SymfonyBaseCommand;
use Symfony\Component\Console\Command\ListCommand;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;
use Symfony\Component\Console\DependencyInjection\AddConsoleCommandPass;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Throwable;

/**
 * Class Application
 *
 * @package Lafiel\Declarator\Console
 * @author Mike Gerritsen <mike.van.bezooijen@gmail.com>
 * @since 15/03/2017 19:40
 */
class Application extends BaseApplication
{
    /**
     * @link http://patorjk.com/software/taag/#p=display&f=Slant&t=Docker%20PHP%20Process
     * @var string
     */
    private static $logo = '    ____             __                ____  __  ______     ____                                
   / __ \____  _____/ /_____  _____   / __ \/ / / / __ \   / __ \_________  ________  __________
  / / / / __ \/ ___/ //_/ _ \/ ___/  / /_/ / /_/ / /_/ /  / /_/ / ___/ __ \/ ___/ _ \/ ___/ ___/
 / /_/ / /_/ / /__/ ,< /  __/ /     / ____/ __  / ____/  / ____/ /  / /_/ / /__/  __(__  |__  ) 
/_____/\____/\___/_/|_|\___/_/     /_/   /_/ /_/_/      /_/   /_/   \____/\___/\___/____/____/  
                                                                                                
';

    /**
     * @var bool
     */
    private $commandsRegistered = false;

    /**
     * @var Throwable[]
     */
    private $registrationErrors = [];

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        parent::__construct('Docker process', '1.0.0');
    }

    /**
     * @inheritdoc
     */
    public function getHelp()
    {
        return static::$logo . parent::getHelp();
    }

    /**
     * {@inheritDoc}
     */
    public function run(InputInterface $input = null, OutputInterface $output = null)
    {
        if (null === $output) {
            $styles = [];
            $formatter = new OutputFormatter(false, $styles);
            $output = new ConsoleOutput(ConsoleOutput::VERBOSITY_NORMAL, null, $formatter);
        }

        if (null === $input) {
            $input = new ArgvInput();
        }

        $output = new SymfonyStyle($input, $output);

        return parent::run($input, $output);
    }

    /**
     * @return string
     */
    public function getRootDirectory(): string
    {
        return getenv('APPLICATION_ROOT');
    }

    /**
     * @return ContainerInterface Returns the container, or null when the loading failed
     */
    private function getContainer(): ?ContainerInterface
    {
        if ($this->container === null) {

            try {
                $this->container = new ContainerBuilder();
                $loader = new YamlFileLoader($this->container, new FileLocator($this->getRootDirectory()));
                $loader->load('config/services.yaml');

//                $this->container->get();
                $this->container->addCompilerPass(new AddConsoleCommandPass());
                $this->container->compile();
            } catch (Exception $e) {
                dump($e);
                $this->container = null;
            }
        }

        return $this->container;
    }

    /**
     * Runs the current application.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int 0 if everything went fine, or an error code
     * @throws Throwable
     */
    public function doRun(InputInterface $input, OutputInterface $output): int
    {
        $this->registerCommands();

        if ($this->registrationErrors) {
            $this->renderRegistrationErrors($input, $output);
        }

        return parent::doRun($input, $output);
    }

    /**
     * {@inheritdoc}
     * @throws Throwable
     */
    protected function doRunCommand(SymfonyBaseCommand $command, InputInterface $input, OutputInterface $output)
    {
        if (!$command instanceof ListCommand) {
            if ($this->registrationErrors) {
                $this->renderRegistrationErrors($input, $output);
                $this->registrationErrors = [];
            }

            return parent::doRunCommand($command, $input, $output);
        }

        $returnCode = parent::doRunCommand($command, $input, $output);

        if ($this->registrationErrors) {
            $this->renderRegistrationErrors($input, $output);
            $this->registrationErrors = [];
        }

        return $returnCode;
    }

    /**
     * {@inheritdoc}
     */
    public function find($name)
    {
        $this->registerCommands();

        return parent::find($name);
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        $this->registerCommands();

        $command = parent::get($name);

        if ($command instanceof ContainerAwareInterface) {
            $command->setContainer($this->getContainer());
        }

        return $command;
    }

    /**
     * {@inheritdoc}
     */
    public function all($namespace = null)
    {
        $this->registerCommands();

        return parent::all($namespace);
    }

    public function add(SymfonyBaseCommand $command)
    {
        $this->registerCommands();

        return parent::add($command);
    }

    protected function registerCommands()
    {
        if ($this->commandsRegistered) {
            return;
        }

        $this->commandsRegistered = true;

        $container = $this->getContainer();

        if ($container->has('console.command_loader')) {

            /* @var $commandLoader CommandLoaderInterface */
            $commandLoader = $container->get('console.command_loader');

            $this->setCommandLoader($commandLoader);
        }

        if ($container->hasParameter('console.command.ids')) {
            $lazyCommandIds = $container->hasParameter('console.lazy_command.ids') ? $container->getParameter('console.lazy_command.ids') : [];
            foreach ($container->getParameter('console.command.ids') as $id) {
                if (!isset($lazyCommandIds[$id])) {
                    try {

                        /* @var $command SymfonyBaseCommand */
                        $command = $container->get($id);

                        $this->add($command);
                    } catch (Throwable $e) {
                        $this->registrationErrors[] = $e;
                    }
                }
            }
        }
    }

    private function renderRegistrationErrors(InputInterface $input, OutputInterface $output)
    {
        if ($output instanceof ConsoleOutputInterface) {
            $output = $output->getErrorOutput();
        }

        $output->warning('Some commands could not be registered:');

        foreach ($this->registrationErrors as $error) {
            $this->doRenderThrowable($error, $output);
        }
    }
}
