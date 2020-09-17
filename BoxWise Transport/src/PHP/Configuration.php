<?php


namespace PenD\PHP;

// todo create custom exception
use Exception AS ConfigurationException;
use RuntimeException AS SpecialConfigurationException;
use LogicException AS NonExistingConfigurationException;

/**
 * Class Configuration
 * Object interface for ini setting/ configurations of PHP
 *
 *
 * @link http://php.net/manual/en/function.ini-get.php
 * @link http://php.net/manual/en/function.ini-set.php
 * @link http://php.net/manual/en/function.ini-reset.php
 *
 * @package Lafiel\PHP
 * @author Mike Gerritsen <mike@van.bezooijen.net>
 * @since 16/03/2017 09:22
 */
class Configuration
{

    /**
     * Entry can be set in user scripts (like with ini_set()) or in the Windows registry.
     * Since PHP 5.3, entry can be set in .user.ini
     */
    const ACCESS_USER = 0b001;

    /**
     * Entry can be set in php.ini, .htaccess or httpd.conf
     */
    const ACCESS_PERDIR = 0b010;

    /**
     * Entry can be set in php.ini or httpd.conf
     */
    const ACCESS_SYSTEM = 0b100;

    /**
     * Entry can be set anywhere
     */
    const ACCESS_ALL = 0b111;

    /**
     * The name of the directive
     * @var string
     */
    private $directive;

    /**
     * The access level for this configuration directive
     *
     * It's possible for a directive to have multiple access levels,
     * which is why access shows the appropriate bitmask values.
     * @var integer
     */
    private $access;

    /**
     * @var
     */
    static $all;

    /**
     * This Key/Value map are space and require modification of the php.ini
     * @var mixed[]
     */
    static $special = [
        /**
         * @link http://php.net/manual/en/phar.configuration.php#ini.phar.readonly
         * @see NOTE section, it can only be changed from the ini file
         */
        'phar.readonly' => 1,
    ];

    /**
     * Configuration constructor.
     * @param string $directive
     * @throws NonExistingConfigurationException when $directive does not exist
     */
    public function __construct($directive)
    {
        $this->directive = $directive;

        if (@ini_get($directive) === false) {
            throw new NonExistingConfigurationException(sprintf(
                'configuration directive "%s" does not exists',
                $directive
            ));
        }

        $this->getAccess();
    }

    /**
     * Returns the value of the configuration directive.
     * @return string
     */
    public function get()
    {
        return @ini_get($this->directive);
    }

    /**
     * Sets the value of the configuration directive.
     * The configuration will keep this new value during the script's execution,
     * and will be restored at the script's ending.
     *
     * @param mixed $value
     * @return string
     * @throws ConfigurationAccessDeniedException
     * @throws ConfigurationException
     */
    public function set($value)
    {
        if (($this->access & static::ACCESS_USER) !== static::ACCESS_USER) {
            throw new ConfigurationAccessDeniedException($this->directive, $this->access);
        }
        $result = ini_get($this->directive);

        if (isset(static::$special[$this->directive]) && static::$special[$this->directive] == $result) {
            throw new SpecialConfigurationException(
                'The special setting "'.$this->directive.'" was detected, please configure it in the php.ini'
            );
        }

        if ($result !== $value) {
            $result = @ini_set($this->directive, $value);

            if ($result === false) {
                throw new ConfigurationException('failed setting the configuration');
            }
        }

        return $result;
    }

    /**
     * Restores the configuration directive to its original value.
     * @return void
     */
    public function restore()
    {
        ini_restore($this->directive);
    }

    public function getAccess()
    {
        if ($this->access === null) {
            $this->fetchAccessFor($this->directive);
        }

        return $this->access;
    }

    /**
     * @param string $directive
     */
    private function fetchAccessFor($directive)
    {
        $allConfigurations = ini_get_all();

        $this->access = $allConfigurations[$directive]['access'];
    }
}
