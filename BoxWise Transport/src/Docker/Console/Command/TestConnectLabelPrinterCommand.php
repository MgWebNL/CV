<?php

namespace PenD\Docker\Console\Command;

use Smalot\Cups\Builder\Builder;
use Smalot\Cups\Manager\JobManager;
use Smalot\Cups\Manager\PrinterManager;
use Smalot\Cups\Model\Job;
use Smalot\Cups\Transport\Client;
use Smalot\Cups\Transport\ResponseParser;
use PenD\Docker\Console\Command\ProfitManagerBaseCommand AS BaseCommand;
use PenD\Docker\Console\ExitCode;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ImportSystemUsersV2Command
 *
 * @package PenD\Docker\Console\Command
 * @author Mike Gerritsen <mike@pend-group.com>
 * @since 15/04/2020 15:54
 */
class TestConnectLabelPrinterCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('test:connect-printer')
            ->setAliases(['test-printer'])
            ->setDescription('Dit is een testomgeving tbv het opzetten koppeling LABELPRINTER VEENENDAAL')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $em = $this->getEntityManager();

        try {

            $client = new Client();
            $builder = new Builder();
            $responseParser = new ResponseParser();

            $printerManager = new PrinterManager($builder, $client, $responseParser);
            $printer = $printerManager->findByUri('http://h2772775.stratoserver.net/printers/Test');

            $jobManager = new JobManager($builder, $client, $responseParser);

            $jobs = $jobManager->getList($printer, false, 0, 'completed');

            foreach ($jobs as $job) {
                echo '#'.$job->getId().' '.$job->getName().' - '.$job->getState().PHP_EOL;
            }
            die();

            $job = new Job();
            $job->setName('job create file');
            $job->setUsername('demo');
            $job->setCopies(1);
            $job->setPageRanges('1');
            $job->addFile('./helloworld.pdf');
            $job->addAttribute('media', 'A4');
            $job->addAttribute('fit-to-page', true);
            $result = $jobManager->send($printer, $job);


            $exitCode = ExitCode::OK;
        } catch (\Throwable $e) {

            if ($em->getConnection()->isTransactionActive()) {
                $em->rollback();
            }

            dump($e);

            $exitCode = ExitCode::ERROR;
        }

        return $exitCode;
    }
}