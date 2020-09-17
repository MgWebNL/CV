<?php

namespace PenD\Docker\Application\Model;

/**
 * Schemaversiondbupgrade
 */
class Schemaversiondbupgrade
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $version;

    /**
     * @var \DateTime
     */
    private $bumpdate;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set version.
     *
     * @param string|null $version
     *
     * @return Schemaversiondbupgrade
     */
    public function setVersion($version = null)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version.
     *
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set bumpdate.
     *
     * @param \DateTime $bumpdate
     *
     * @return Schemaversiondbupgrade
     */
    public function setBumpdate($bumpdate)
    {
        $this->bumpdate = $bumpdate;

        return $this;
    }

    /**
     * Get bumpdate.
     *
     * @return \DateTime
     */
    public function getBumpdate()
    {
        return $this->bumpdate;
    }
}
