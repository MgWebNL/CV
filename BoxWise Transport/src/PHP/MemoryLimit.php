<?php


namespace PenD\PHP;

/**
 * Class MemoryLimit
 *
 * Configures the php memory limit to the given amount, when the current limit is smaller then the given limit
 *
 * @package Lafiel\System
 * @author Mike Gerritsen <mike@van.bezooijen.net>
 * @since 16/03/2017 09:14
 */
class MemoryLimit extends Configuration
{
    /**
     * MemoryLimit constructor.
     *
     * Sets the PHP memory limit when the current limit is smaller then the given limit
     *
     * @param string $limit [default] 1024M
     */
    public function __construct($limit = '1024M')
    {
        parent::__construct('memory_limit');

        $this->set($limit);
    }

    /**
     * @inheritdoc
     * Set the Memory limit to the given value
     * @param mixed $value
     * @return string
     */
    public function set($value)
    {
        $displayErrors = new Configuration('display_errors');
        $displayErrors->set(1);

        $memoryLimit = trim($this->get());
        // Increase memory_limit if it is lower than specified value
        if ($memoryLimit != -1 && $this->memoryInBytes($memoryLimit) < $this->memoryInBytes($value)) {
            $result = parent::set($value);
        } else {
            $result = $memoryLimit;
        }

        unset($memoryInBytes, $memoryLimit);

        return $result;
    }

    /**
     * @param $value
     * @return int
     */
    private function memoryInBytes($value)
    {
        $unit = strtolower(substr($value, -1, 1));
        $value = (int) $value;

        switch($unit) {
            case 'g':
                $value *= 1024;
            // no break (cumulative multiplier)
            case 'm':
                $value *= 1024;
            // no break (cumulative multiplier)
            case 'k':
                $value *= 1024;
        }

        return $value;
    }
}