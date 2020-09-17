<?php

namespace PenD\Docker\Application\Model;

/**
 * Scripttasks
 */
class Scripttasks
{
    /**
     * @var int
     */
    private $scripttaskPk;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string
     */
    private $script;

    /**
     * @var \DateTime
     */
    private $startdate;

    /**
     * @var \DateTime|null
     */
    private $enddate;

    /**
     * @var string|null
     */
    private $minutes = '*';

    /**
     * @var string|null
     */
    private $hours = '*';

    /**
     * @var string|null
     */
    private $days = '*';

    /**
     * @var string|null
     */
    private $months = '*';

    /**
     * @var int
     */
    private $priority;

    /**
     * @var bool|null
     */
    private $active = '0';

    /**
     * @var bool
     */
    private $executeonmonday = '0';

    /**
     * @var bool
     */
    private $executeontuesday = '0';

    /**
     * @var bool
     */
    private $executeonwednesday = '0';

    /**
     * @var bool
     */
    private $executeonthursday = '0';

    /**
     * @var bool
     */
    private $executeonfriday = '0';

    /**
     * @var bool
     */
    private $executeonsaturday = '0';

    /**
     * @var bool
     */
    private $executeonsunday = '0';

    /**
     * @var int
     */
    private $userid;

    /**
     * @var int
     */
    private $zoneid;

    /**
     * @var \DateTime
     */
    private $createdon;

    /**
     * @var string
     */
    private $createdby;

    /**
     * @var \DateTime
     */
    private $modifiedon;

    /**
     * @var string
     */
    private $modifiedby;

    /**
     * @var string
     */
    private $rowversion;


    /**
     * Get scripttaskPk.
     *
     * @return int
     */
    public function getScripttaskPk()
    {
        return $this->scripttaskPk;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Scripttasks
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Scripttasks
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set script.
     *
     * @param string $script
     *
     * @return Scripttasks
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script.
     *
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set startdate.
     *
     * @param \DateTime $startdate
     *
     * @return Scripttasks
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate.
     *
     * @return \DateTime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate.
     *
     * @param \DateTime|null $enddate
     *
     * @return Scripttasks
     */
    public function setEnddate($enddate = null)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate.
     *
     * @return \DateTime|null
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set minutes.
     *
     * @param string|null $minutes
     *
     * @return Scripttasks
     */
    public function setMinutes($minutes = null)
    {
        $this->minutes = $minutes;

        return $this;
    }

    /**
     * Get minutes.
     *
     * @return string|null
     */
    public function getMinutes()
    {
        return $this->minutes;
    }

    /**
     * Set hours.
     *
     * @param string|null $hours
     *
     * @return Scripttasks
     */
    public function setHours($hours = null)
    {
        $this->hours = $hours;

        return $this;
    }

    /**
     * Get hours.
     *
     * @return string|null
     */
    public function getHours()
    {
        return $this->hours;
    }

    /**
     * Set days.
     *
     * @param string|null $days
     *
     * @return Scripttasks
     */
    public function setDays($days = null)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days.
     *
     * @return string|null
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * Set months.
     *
     * @param string|null $months
     *
     * @return Scripttasks
     */
    public function setMonths($months = null)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * Get months.
     *
     * @return string|null
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * Set priority.
     *
     * @param int $priority
     *
     * @return Scripttasks
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set active.
     *
     * @param bool|null $active
     *
     * @return Scripttasks
     */
    public function setActive($active = null)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool|null
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set executeonmonday.
     *
     * @param bool $executeonmonday
     *
     * @return Scripttasks
     */
    public function setExecuteonmonday($executeonmonday)
    {
        $this->executeonmonday = $executeonmonday;

        return $this;
    }

    /**
     * Get executeonmonday.
     *
     * @return bool
     */
    public function getExecuteonmonday()
    {
        return $this->executeonmonday;
    }

    /**
     * Set executeontuesday.
     *
     * @param bool $executeontuesday
     *
     * @return Scripttasks
     */
    public function setExecuteontuesday($executeontuesday)
    {
        $this->executeontuesday = $executeontuesday;

        return $this;
    }

    /**
     * Get executeontuesday.
     *
     * @return bool
     */
    public function getExecuteontuesday()
    {
        return $this->executeontuesday;
    }

    /**
     * Set executeonwednesday.
     *
     * @param bool $executeonwednesday
     *
     * @return Scripttasks
     */
    public function setExecuteonwednesday($executeonwednesday)
    {
        $this->executeonwednesday = $executeonwednesday;

        return $this;
    }

    /**
     * Get executeonwednesday.
     *
     * @return bool
     */
    public function getExecuteonwednesday()
    {
        return $this->executeonwednesday;
    }

    /**
     * Set executeonthursday.
     *
     * @param bool $executeonthursday
     *
     * @return Scripttasks
     */
    public function setExecuteonthursday($executeonthursday)
    {
        $this->executeonthursday = $executeonthursday;

        return $this;
    }

    /**
     * Get executeonthursday.
     *
     * @return bool
     */
    public function getExecuteonthursday()
    {
        return $this->executeonthursday;
    }

    /**
     * Set executeonfriday.
     *
     * @param bool $executeonfriday
     *
     * @return Scripttasks
     */
    public function setExecuteonfriday($executeonfriday)
    {
        $this->executeonfriday = $executeonfriday;

        return $this;
    }

    /**
     * Get executeonfriday.
     *
     * @return bool
     */
    public function getExecuteonfriday()
    {
        return $this->executeonfriday;
    }

    /**
     * Set executeonsaturday.
     *
     * @param bool $executeonsaturday
     *
     * @return Scripttasks
     */
    public function setExecuteonsaturday($executeonsaturday)
    {
        $this->executeonsaturday = $executeonsaturday;

        return $this;
    }

    /**
     * Get executeonsaturday.
     *
     * @return bool
     */
    public function getExecuteonsaturday()
    {
        return $this->executeonsaturday;
    }

    /**
     * Set executeonsunday.
     *
     * @param bool $executeonsunday
     *
     * @return Scripttasks
     */
    public function setExecuteonsunday($executeonsunday)
    {
        $this->executeonsunday = $executeonsunday;

        return $this;
    }

    /**
     * Get executeonsunday.
     *
     * @return bool
     */
    public function getExecuteonsunday()
    {
        return $this->executeonsunday;
    }

    /**
     * Set userid.
     *
     * @param int $userid
     *
     * @return Scripttasks
     */
    public function setUserid($userid)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid.
     *
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set zoneid.
     *
     * @param int $zoneid
     *
     * @return Scripttasks
     */
    public function setZoneid($zoneid)
    {
        $this->zoneid = $zoneid;

        return $this;
    }

    /**
     * Get zoneid.
     *
     * @return int
     */
    public function getZoneid()
    {
        return $this->zoneid;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Scripttasks
     */
    public function setCreatedon($createdon)
    {
        $this->createdon = $createdon;

        return $this;
    }

    /**
     * Get createdon.
     *
     * @return \DateTime
     */
    public function getCreatedon()
    {
        return $this->createdon;
    }

    /**
     * Set createdby.
     *
     * @param string $createdby
     *
     * @return Scripttasks
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby.
     *
     * @return string
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set modifiedon.
     *
     * @param \DateTime $modifiedon
     *
     * @return Scripttasks
     */
    public function setModifiedon($modifiedon)
    {
        $this->modifiedon = $modifiedon;

        return $this;
    }

    /**
     * Get modifiedon.
     *
     * @return \DateTime
     */
    public function getModifiedon()
    {
        return $this->modifiedon;
    }

    /**
     * Set modifiedby.
     *
     * @param string $modifiedby
     *
     * @return Scripttasks
     */
    public function setModifiedby($modifiedby)
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }

    /**
     * Get modifiedby.
     *
     * @return string
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }

    /**
     * Set rowversion.
     *
     * @param string $rowversion
     *
     * @return Scripttasks
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
