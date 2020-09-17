<?php

namespace PenD\Docker\Application\Model;

/**
 * Notifications
 */
class Notifications
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string|null
     */
    private $reference;

    /**
     * @var int|null
     */
    private $severity;

    /**
     * @var string|null
     */
    private $gotolink;

    /**
     * @var string|null
     */
    private $translationkey;

    /**
     * @var string|null
     */
    private $translationdata;

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
     * @var \PenD\Docker\Application\Model\Notificationgroups
     */
    private $notificationgroupkey;

    /**
     * @var \PenD\Docker\Application\Model\Zones
     */
    private $zonepk;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userPk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userPk = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set reference.
     *
     * @param string|null $reference
     *
     * @return Notifications
     */
    public function setReference($reference = null)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set severity.
     *
     * @param int|null $severity
     *
     * @return Notifications
     */
    public function setSeverity($severity = null)
    {
        $this->severity = $severity;

        return $this;
    }

    /**
     * Get severity.
     *
     * @return int|null
     */
    public function getSeverity()
    {
        return $this->severity;
    }

    /**
     * Set gotolink.
     *
     * @param string|null $gotolink
     *
     * @return Notifications
     */
    public function setGotolink($gotolink = null)
    {
        $this->gotolink = $gotolink;

        return $this;
    }

    /**
     * Get gotolink.
     *
     * @return string|null
     */
    public function getGotolink()
    {
        return $this->gotolink;
    }

    /**
     * Set translationkey.
     *
     * @param string|null $translationkey
     *
     * @return Notifications
     */
    public function setTranslationkey($translationkey = null)
    {
        $this->translationkey = $translationkey;

        return $this;
    }

    /**
     * Get translationkey.
     *
     * @return string|null
     */
    public function getTranslationkey()
    {
        return $this->translationkey;
    }

    /**
     * Set translationdata.
     *
     * @param string|null $translationdata
     *
     * @return Notifications
     */
    public function setTranslationdata($translationdata = null)
    {
        $this->translationdata = $translationdata;

        return $this;
    }

    /**
     * Get translationdata.
     *
     * @return string|null
     */
    public function getTranslationdata()
    {
        return $this->translationdata;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Notifications
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
     * @return Notifications
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
     * @return Notifications
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
     * @return Notifications
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
     * @return Notifications
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
     * Set notificationgroupkey.
     *
     * @param \PenD\Docker\Application\Model\Notificationgroups|null $notificationgroupkey
     *
     * @return Notifications
     */
    public function setNotificationgroupkey(\PenD\Docker\Application\Model\Notificationgroups $notificationgroupkey = null)
    {
        $this->notificationgroupkey = $notificationgroupkey;

        return $this;
    }

    /**
     * Get notificationgroupkey.
     *
     * @return \PenD\Docker\Application\Model\Notificationgroups|null
     */
    public function getNotificationgroupkey()
    {
        return $this->notificationgroupkey;
    }

    /**
     * Set zonepk.
     *
     * @param \PenD\Docker\Application\Model\Zones|null $zonepk
     *
     * @return Notifications
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
     * Add userPk.
     *
     * @param \PenD\Docker\Application\Model\Users $userPk
     *
     * @return Notifications
     */
    public function addUserPk(\PenD\Docker\Application\Model\Users $userPk)
    {
        $this->userPk[] = $userPk;

        return $this;
    }

    /**
     * Remove userPk.
     *
     * @param \PenD\Docker\Application\Model\Users $userPk
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserPk(\PenD\Docker\Application\Model\Users $userPk)
    {
        return $this->userPk->removeElement($userPk);
    }

    /**
     * Get userPk.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserPk()
    {
        return $this->userPk;
    }
}
