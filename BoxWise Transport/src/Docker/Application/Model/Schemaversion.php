<?php

namespace PenD\Docker\Application\Model;

/**
 * Schemaversion
 */
class Schemaversion
{
    /**
     * @var string
     */
    private $version;

    /**
     * @var \DateTime
     */
    private $datetime = 'CURRENT_TIMESTAMP';


    /**
     * Get version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set datetime.
     *
     * @param \DateTime $datetime
     *
     * @return Schemaversion
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime.
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }
}
