<?php

namespace PenD\Docker\Application\Model;

/**
 * Batchactivity
 */
class Batchactivity
{
    /**
     * @var int
     */
    private $batchactivityPk;

    /**
     * @var int
     */
    private $batchesFk;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $devicename;

    /**
     * @var string
     */
    private $activity;

    /**
     * @var \DateTime
     */
    private $time;

    /**
     * @var string|null
     */
    private $notes;

    /**
     * @var string
     */
    private $rowversion;


    /**
     * Get batchactivityPk.
     *
     * @return int
     */
    public function getBatchactivityPk()
    {
        return $this->batchactivityPk;
    }

    /**
     * Set batchesFk.
     *
     * @param int $batchesFk
     *
     * @return Batchactivity
     */
    public function setBatchesFk($batchesFk)
    {
        $this->batchesFk = $batchesFk;

        return $this;
    }

    /**
     * Get batchesFk.
     *
     * @return int
     */
    public function getBatchesFk()
    {
        return $this->batchesFk;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Batchactivity
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set devicename.
     *
     * @param string $devicename
     *
     * @return Batchactivity
     */
    public function setDevicename($devicename)
    {
        $this->devicename = $devicename;

        return $this;
    }

    /**
     * Get devicename.
     *
     * @return string
     */
    public function getDevicename()
    {
        return $this->devicename;
    }

    /**
     * Set activity.
     *
     * @param string $activity
     *
     * @return Batchactivity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity.
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set time.
     *
     * @param \DateTime $time
     *
     * @return Batchactivity
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time.
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set notes.
     *
     * @param string|null $notes
     *
     * @return Batchactivity
     */
    public function setNotes($notes = null)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set rowversion.
     *
     * @param string $rowversion
     *
     * @return Batchactivity
     */
    public function setRowversion($rowversion)
    {
        $this->rowversion = $rowversion;

        return $this;
    }

    /**
     * Get rowversion.
     *
     * @return string
     */
    public function getRowversion()
    {
        return $this->rowversion;
    }
}
