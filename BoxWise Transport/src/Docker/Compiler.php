<?php

namespace PenD\Docker;

use DateTime;
use DateTimeZone;
use Phar;
use RuntimeException;
use SplFileInfo;
use \Symfony\Component\Finder\SplFileInfo AS SymfonyFileInfo;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

/**
 * Class Compiler
 * The Compiler class compiles auto billing into a phar
 * @package PenD\Docker
 * @author Mike Gerritsen <mike.van.bezooijen@gmail.com>
 * @since 16/03/2017 09:04
 */
class Compiler
{
    /**
     * @var
     */
    private $version;

    /**
     * @var DateTime
     */
    private $versionDate;

    /**
     * Compiles composer into a single phar file
     *
     * @param  string            $pharFile The full path to the file to create
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function compile($pharFile = 'auto-billing.phar')
    {
        if (file_exists($pharFile)) {
            unlink($pharFile);
        }

        $process = new Process('git log --pretty="%H" -n1 HEAD', __DIR__);
        if ($process->run() != 0) {
            throw new RuntimeException('Can\'t run git log. You must ensure to run compile from composer git repository clone and that git binary is available.');
        }
        $this->version = trim($process->getOutput());

        $process = new Process('git log -n1 --pretty=%ci HEAD', __DIR__);
        if ($process->run() != 0) {
            throw new RuntimeException('Can\'t run git log. You must ensure to run compile from composer git repository clone and that git binary is available.');
        }

        $this->versionDate = new DateTime(trim($process->getOutput()));
        $this->versionDate->setTimezone(new DateTimeZone('UTC'));

        $process = new Process('git describe --tags --exact-match HEAD');
        if ($process->run() == 0) {
            $this->version = trim($process->getOutput());
        }

        $phar = new Phar($pharFile, 0, 'auto-billing.phar');
        $phar->setSignatureAlgorithm(Phar::SHA1);

        $phar->startBuffering();

        $finderSort = function (SymfonyFileInfo $a, SymfonyFileInfo $b) {
            return strcmp(strtr($a->getRealPath(), '\\', '/'), strtr($b->getRealPath(), '\\', '/'));
        };

        $finder = new Finder();
        $finder->files()
            ->ignoreVCS(true)
            ->name('*.php')
            ->notName('Compiler.php')
            ->notName('ClassLoader.php')
            ->in(__DIR__.'/..')
            ->sort($finderSort)
        ;

        foreach ($finder as $file) {
            $this->addFile($phar, $file);
        }

        $finder = new Finder();
        $finder->files()
//            ->name('*.json')
            ->in(__DIR__.'/../../res')
            ->sort($finderSort)
        ;

        foreach ($finder as $file) {
            $this->addFile($phar, $file, false);
        }

        $finder = new Finder();
        $finder->files()
            ->ignoreVCS(true)
            ->name('*.php')
//            ->name('LICENSE')
            ->exclude('Tests')
            ->exclude('tests')
            ->exclude('docs')
            ->in(__DIR__.'/../../vendor/')
            ->sort($finderSort)
        ;

        foreach ($finder as $file) {
            $this->addFile($phar, $file);
        }

        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/autoload.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_namespaces.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_psr4.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_classmap.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_files.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_real.php'));
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/autoload_static.php'));
        if (file_exists(__DIR__.'/../../vendor/composer/include_paths.php')) {
            $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/include_paths.php'));
        }
        $this->addFile($phar, new SplFileInfo(__DIR__.'/../../vendor/composer/ClassLoader.php'));

        $this->addComposerBin($phar);

        // Stubs
        $phar->setStub($this->getStub());

        $phar->stopBuffering();

        // disabled for interoperability with systems without gzip ext
        // $phar->compressFiles(\Phar::GZ);

        unset($phar);

//        // re-sign the phar with reproducible timestamp / signature
//        $util = new Timestamps($pharFile);
//        $util->updateTimestamps($this->versionDate);
//        $util->save($pharFile, \Phar::SHA1);
    }

    /**
     * @param Phar $phar
     * @param SplFileInfo $file
     * @param bool $strip
     */
    private function addFile($phar, $file, $strip = true)
    {
        $path = strtr(str_replace(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR, '', $file->getRealPath()), '\\', '/');

        $content = file_get_contents($file);
        if ($strip) {
            $content = $this->stripWhitespace($content);
        } elseif ('LICENSE' === basename($file)) {
            $content = "\n".$content."\n";
        }

//        if ($path === 'src/Docker/Docker.php') {
//            $content = str_replace('@package_version@', $this->version, $content);
//            $content = str_replace('@package_branch_alias_version@', $this->branchAliasVersion, $content);
//            $content = str_replace('@release_date@', $this->versionDate->format('Y-m-d H:i:s'), $content);
//        }

        $phar->addFromString($path, $content);
    }

    /**
     * @param Phar $phar
     */
    private function addComposerBin($phar)
    {
        $content = file_get_contents(__DIR__.'/../../bin/console');
        $content = preg_replace('{^#!/usr/bin/env php\s*}', '', $content);
        $phar->addFromString('bin/console', $content);
    }

    /**
     * Removes whitespace from a PHP source string while preserving line numbers.
     *
     * @param  string $source A PHP string
     * @return string The PHP string with the whitespace removed
     */
    private function stripWhitespace($source)
    {
        if (!function_exists('token_get_all')) {
            return $source;
        }

        $output = '';
        foreach (token_get_all($source) as $token) {
            if (is_string($token)) {
                $output .= $token;
            } elseif (in_array($token[0], array(T_COMMENT, T_DOC_COMMENT))) {
                $output .= str_repeat("\n", substr_count($token[1], "\n"));
            } elseif (T_WHITESPACE === $token[0]) {
                // reduce wide spaces
                $whitespace = preg_replace('{[ \t]+}', ' ', $token[1]);
                // normalize newlines to \n
                $whitespace = preg_replace('{(?:\r\n|\r|\n)}', "\n", $whitespace);
                // trim leading spaces
                $whitespace = preg_replace('{\n +}', "\n", $whitespace);
                $output .= $whitespace;
            } else {
                $output .= $token[1];
            }
        }

        return $output;
    }

    /**
     * Create the phar stub information
     * @return string
     */
    private function getStub()
    {
        $stub = <<<'EOF'
#!/usr/bin/env php
<?php
/*
 * This file is part of Lafiel Auto Docker.
 *
 * (c) Mike Gerritsen <mike@van.bezooijen.net>
 *
 * For the full copyright and license information, please view
 * the license that is located at the bottom of this file.
 */

Phar::mapPhar('auto-billing.phar');

EOF;

        return $stub . <<<'EOF'
require 'phar://auto-billing.phar/bin/console';

__HALT_COMPILER();
EOF;
    }
}