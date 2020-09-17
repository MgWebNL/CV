<?php

namespace PenD\PHP;

use Exception;
use RuntimeException;

/**
 * Class ConfigurationAccessDeniedException
 * @package Lafiel\PHP
 * @author Mike Gerritsen <mike.van.bezooijen@gmail.com>
 * @since 16/03/2017 10:16
 */
class ConfigurationAccessDeniedException extends RuntimeException
{
    public function __construct($directive, $access, Exception $previous = null)
    {
        $configLocation = [];

        if (($access & Configuration::ACCESS_PERDIR) === Configuration::ACCESS_PERDIR) {
            $configLocation[] = '.htaccess';
        }

        if (($access & Configuration::ACCESS_SYSTEM) === Configuration::ACCESS_SYSTEM) {
            $configLocation[] = 'php.ini or httpd.conf';
        }

        $message = sprintf(
            'Directive "%s" can be set in %s',
            $directive,
            implode(', ', $configLocation)
        );

        parent::__construct($message, $access, $previous);
    }
}