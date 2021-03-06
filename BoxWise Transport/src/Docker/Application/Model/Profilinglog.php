<?php

namespace PenD\Docker\Application\Model;

/**
 * Profilinglog
 */
class Profilinglog
{
    /**
     * @var int
     */
    private $profilinglogPk;

    /**
     * @var string|null
     */
    private $activityid;

    /**
     * @var int|null
     */
    private $methodid;

    /**
     * @var int|null
     */
    private $previousmethodid;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string|null
     */
    private $clientname;

    /**
     * @var string|null
     */
    private $accessid;

    /**
     * @var int
     */
    private $thread;

    /**
     * @var \DateTime
     */
    private $timestamp;

    /**
     * @var string
     */
    private $eventtype;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string|null
     */
    private $elapsedseconds;

    /**
     * @var string|null
     */
    private $category;

    /**
     * @var int|null
     */
    private $priority;

    /**
     * @var int|null
     */
    private $eventid;

    /**
     * @var string|null
     */
    private $title;

    /**
     * @var string
     */
    private $machinename;

    /**
     * @var string
     */
    private $appdomain;

    /**
     * @var string|null
     */
    private $processid;

    /**
     * @var string
     */
    private $processname;

    /**
     * @var string
     */
    private $windowsidentity;

    /**
     * @var \DateTime
     */
    private $createdon = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $createdby = 'SYSTEM';

    /**
     * @var \DateTime
     */
    private $modifiedon = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $modifiedby = 'SYSTEM';

    /**
     * @var string
     */
    private $rowversion;

    /**
     * @var int|null
     */
    private $userkey;


    /**
     * Get profilinglogPk.
     *
     * @return int
     */
    public function getProfilinglogPk()
    {
        return $this->profilinglogPk;
    }

    /**
     * Set activityid.
     *
     * @param string|null $activityid
     *
     * @return Profilinglog
     */
    public function setActivityid($activityid = null)
    {
        $this->activityid = $activityid;

        return $this;
    }

    /**
     * Get activityid.
     *
     * @return string|null
     */
    public function getActivityid()
    {
        return $this->activityid;
    }

    /**
     * Set methodid.
     *
     * @param int|null $methodid
     *
     * @return Profilinglog
     */
    public function setMethodid($methodid = null)
    {
        $this->methodid = $methodid;

        return $this;
    }

    /**
     * Get methodid.
     *
     * @return int|null
     */
    public function getMethodid()
    {
        return $this->methodid;
    }

    /**
     * Set previousmethodid.
     *
     * @param int|null $previousmethodid
     *
     * @return Profilinglog
     */
    public function setPreviousmethodid($previousmethodid = null)
    {
        $this->previousmethodid = $previousmethodid;

        return $this;
    }

    /**
     * Get previousmethodid.
     *
     * @return int|null
     */
    public function getPreviousmethodid()
    {
        return $this->previousmethodid;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Profilinglog
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
     * Set clientname.
     *
     * @param string|null $clientname
     *
     * @return Profilinglog
     */
    public function setClientname($clientname = null)
    {
        $this->clientname = $clientname;

        return $this;
    }

    /**
     * Get clientname.
     *
     * @return string|null
     */
    public function getClientname()
    {
        return $this->clientname;
    }

    /**
     * Set accessid.
     *
     * @param string|null $accessid
     *
     * @return Profilinglog
     */
    public function setAccessid($accessid = null)
    {
        $this->accessid = $accessid;

        return $this;
    }

    /**
     * Get accessid.
     *
     * @return string|null
     */
    public function getAccessid()
    {
        return $this->accessid;
    }

    /**
     * Set thread.
     *
     * @param int $thread
     *
     * @return Profilinglog
     */
    public function setThread($thread)
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * Get thread.
     *
     * @return int
     */
    public function getThread()
    {
        return $this->thread;
    }

    /**
     * Set timestamp.
     *
     * @param \DateTime $timestamp
     *
     * @return Profilinglog
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp.
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set eventtype.
     *
     * @param string $eventtype
     *
     * @return Profilinglog
     */
    public function setEventtype($eventtype)
    {
        $this->eventtype = $eventtype;

        return $this;
    }

    /**
     * Get eventtype.
     *
     * @return string
     */
    public function getEventtype()
    {
        return $this->eventtype;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return Profilinglog
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set elapsedseconds.
     *
     * @param string|null $elapsedseconds
     *
     * @return Profilinglog
     */
    public function setElapsedseconds($elapsedseconds = null)
    {
        $this->elapsedseconds = $elapsedseconds;

        return $this;
    }

    /**
     * Get elapsedseconds.
     *
     * @return string|null
     */
    public function getElapsedseconds()
    {
        return $this->elapsedseconds;
    }

    /**
     * Set category.
     *
     * @param string|null $category
     *
     * @return Profilinglog
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return string|null
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set priority.
     *
     * @param int|null $priority
     *
     * @return Profilinglog
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority.
     *
     * @return int|null
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set eventid.
     *
     * @param int|null $eventid
     *
     * @return Profilinglog
     */
    public function setEventid($eventid = null)
    {
        $this->eventid = $eventid;

        return $this;
    }

    /**
     * Get eventid.
     *
     * @return int|null
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * Set title.
     *
     * @param string|null $title
     *
     * @return Profilinglog
     */
    public function setTitle($title = null)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set machinename.
     *
     * @param string $machinename
     *
     * @return Profilinglog
     */
    public function setMachinename($machinename)
    {
        $this->machinename = $machinename;

        return $this;
    }

    /**
     * Get machinename.
     *
     * @return string
     */
    public function getMachinename()
    {
        return $this->machinename;
    }

    /**
     * Set appdomain.
     *
     * @param string $appdomain
     *
     * @return Profilinglog
     */
    public function setAppdomain($appdomain)
    {
        $this->appdomain = $appdomain;

        return $this;
    }

    /**
     * Get appdomain.
     *
     * @return string
     */
    public function getAppdomain()
    {
        return $this->appdomain;
    }

    /**
     * Set processid.
     *
     * @param string|null $processid
     *
     * @return Profilinglog
     */
    public function setProcessid($processid = null)
    {
        $this->processid = $processid;

        return $this;
    }

    /**
     * Get processid.
     *
     * @return string|null
     */
    public function getProcessid()
    {
        return $this->processid;
    }

    /**
     * Set processname.
     *
     * @param string $processname
     *
     * @return Profilinglog
     */
    public function setProcessname($processname)
    {
        $this->processname = $processname;

        return $this;
    }

    /**
     * Get processname.
     *
     * @return string
     */
    public function getProcessname()
    {
        return $this->processname;
    }

    /**
     * Set windowsidentity.
     *
     * @param string $windowsidentity
     *
     * @return Profilinglog
     */
    public function setWindowsidentity($windowsidentity)
    {
        $this->windowsidentity = $windowsidentity;

        return $this;
    }

    /**
     * Get windowsidentity.
     *
     * @return string
     */
    public function getWindowsidentity()
    {
        return $this->windowsidentity;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Profilinglog
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
     * @return Profilinglog
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
     * @return Profilinglog
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
     * @return Profilinglog
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
     * @return Profilinglog
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

    /**
     * Set userkey.
     *
     * @param int|null $userkey
     *
     * @return Profilinglog
     */
    public function setUserkey($userkey = null)
    {
        $this->userkey = $userkey;

        return $this;
    }

    /**
     * Get userkey.
     *
     * @return int|null
     */
    public function getUserkey()
    {
        return $this->userkey;
    }
}
