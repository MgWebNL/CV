<?php

namespace PenD\Docker\Application\Model;

/**
 * Notificationsummaryconfigurations
 */
class Notificationsummaryconfigurations
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $executiontype;

    /**
     * @var string
     */
    private $scheduletype;

    /**
     * @var \DateTime
     */
    private $lasttimeexecuted;

    /**
     * @var \DateTime
     */
    private $nexttimetoexecute;

    /**
     * @var string|null
     */
    private $executionconfig;

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
     * @var bool
     */
    private $isactive = true;

    /**
     * @var \PenD\Docker\Application\Model\Zones
     */
    private $zonepk;

    /**
     * @var \PenD\Docker\Application\Model\Users
     */
    private $userPk;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Notificationsummaryconfigurations
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
     * Set executiontype.
     *
     * @param string $executiontype
     *
     * @return Notificationsummaryconfigurations
     */
    public function setExecutiontype($executiontype)
    {
        $this->executiontype = $executiontype;

        return $this;
    }

    /**
     * Get executiontype.
     *
     * @return string
     */
    public function getExecutiontype()
    {
        return $this->executiontype;
    }

    /**
     * Set scheduletype.
     *
     * @param string $scheduletype
     *
     * @return Notificationsummaryconfigurations
     */
    public function setScheduletype($scheduletype)
    {
        $this->scheduletype = $scheduletype;

        return $this;
    }

    /**
     * Get scheduletype.
     *
     * @return string
     */
    public function getScheduletype()
    {
        return $this->scheduletype;
    }

    /**
     * Set lasttimeexecuted.
     *
     * @param \DateTime $lasttimeexecuted
     *
     * @return Notificationsummaryconfigurations
     */
    public function setLasttimeexecuted($lasttimeexecuted)
    {
        $this->lasttimeexecuted = $lasttimeexecuted;

        return $this;
    }

    /**
     * Get lasttimeexecuted.
     *
     * @return \DateTime
     */
    public function getLasttimeexecuted()
    {
        return $this->lasttimeexecuted;
    }

    /**
     * Set nexttimetoexecute.
     *
     * @param \DateTime $nexttimetoexecute
     *
     * @return Notificationsummaryconfigurations
     */
    public function setNexttimetoexecute($nexttimetoexecute)
    {
        $this->nexttimetoexecute = $nexttimetoexecute;

        return $this;
    }

    /**
     * Get nexttimetoexecute.
     *
     * @return \DateTime
     */
    public function getNexttimetoexecute()
    {
        return $this->nexttimetoexecute;
    }

    /**
     * Set executionconfig.
     *
     * @param string|null $executionconfig
     *
     * @return Notificationsummaryconfigurations
     */
    public function setExecutionconfig($executionconfig = null)
    {
        $this->executionconfig = $executionconfig;

        return $this;
    }

    /**
     * Get executionconfig.
     *
     * @return string|null
     */
    public function getExecutionconfig()
    {
        return $this->executionconfig;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Notificationsummaryconfigurations
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
     * @return Notificationsummaryconfigurations
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
     * @return Notificationsummaryconfigurations
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
     * @return Notificationsummaryconfigurations
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
     * @return Notificationsummaryconfigurations
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
     * Set isactive.
     *
     * @param bool $isactive
     *
     * @return Notificationsummaryconfigurations
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive.
     *
     * @return bool
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set zonepk.
     *
     * @param \PenD\Docker\Application\Model\Zones|null $zonepk
     *
     * @return Notificationsummaryconfigurations
     */
    public function setZonepk(\PenD\Docker\Application\Model\Zones $zonepk = null)
    {
        $this->zonepk = $zonepk;

        return $this;
    }

    /**
     * Get zonepk.
     *
     * @return \PenD\Docker\Application\Model\Zones|null
     */
    public function getZonepk()
    {
        return $this->zonepk;
    }

    /**
     * Set userPk.
     *
     * @param \PenD\Docker\Application\Model\Users|null $userPk
     *
     * @return Notificationsummaryconfigurations
     */
    public function setUserPk(\PenD\Docker\Application\Model\Users $userPk = null)
    {
        $this->userPk = $userPk;

        return $this;
    }

    /**
     * Get userPk.
     *
     * @return \PenD\Docker\Application\Model\Users|null
     */
    public function getUserPk()
    {
        return $this->userPk;
    }
}
