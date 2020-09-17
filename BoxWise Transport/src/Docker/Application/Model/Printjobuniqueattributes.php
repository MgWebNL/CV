<?php

namespace PenD\Docker\Application\Model;

/**
 * Printjobuniqueattributes
 */
class Printjobuniqueattributes
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $jobtype;

    /**
     * @var \DateTime
     */
    private $usedon;


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
     * Set key.
     *
     * @param string $key
     *
     * @return Printjobuniqueattributes
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set jobtype.
     *
     * @param string $jobtype
     *
     * @return Printjobuniqueattributes
     */
    public function setJobtype($jobtype)
    {
        $this->jobtype = $jobtype;

        return $this;
    }

    /**
     * Get jobtype.
     *
     * @return string
     */
    public function getJobtype()
    {
        return $this->jobtype;
    }

    /**
     * Set usedon.
     *
     * @param \DateTime $usedon
     *
     * @return Printjobuniqueattributes
     */
    public function setUsedon($usedon)
    {
        $this->usedon = $usedon;

        return $this;
    }

    /**
     * Get usedon.
     *
     * @return \DateTime
     */
    public function getUsedon()
    {
        return $this->usedon;
    }
}
