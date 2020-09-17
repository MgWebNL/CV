<?php

namespace PenD\Docker\Application\Model;

/**
 * Users
 */
class Users
{
    /**
     * @var int
     */
    private $userPk;

    /**
     * @var string|null
     */
    private $fullname;

    /**
     * @var string
     */
    private $username;

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var string|null
     */
    private $preferredlanguage;

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
     * @var string|null
     */
    private $customfield;

    /**
     * @var string|null
     */
    private $emailaddress;

    /**
     * @var string|null
     */
    private $hash;

    /**
     * @var string|null
     */
    private $salt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $notificationid;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $zonefk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->notificationid = new \Doctrine\Common\Collections\ArrayCollection();
        $this->zonefk = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get userPk.
     *
     * @return int
     */
    public function getUserPk()
    {
        return $this->userPk;
    }

    /**
     * Set fullname.
     *
     * @param string|null $fullname
     *
     * @return Users
     */
    public function setFullname($fullname = null)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname.
     *
     * @return string|null
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Users
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Users
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set preferredlanguage.
     *
     * @param string|null $preferredlanguage
     *
     * @return Users
     */
    public function setPreferredlanguage($preferredlanguage = null)
    {
        $this->preferredlanguage = $preferredlanguage;

        return $this;
    }

    /**
     * Get preferredlanguage.
     *
     * @return string|null
     */
    public function getPreferredlanguage()
    {
        return $this->preferredlanguage;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Users
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
     * @return Users
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
     * @return Users
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
     * @return Users
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
     * @return Users
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
     * Set customfield.
     *
     * @param string|null $customfield
     *
     * @return Users
     */
    public function setCustomfield($customfield = null)
    {
        $this->customfield = $customfield;

        return $this;
    }

    /**
     * Get customfield.
     *
     * @return string|null
     */
    public function getCustomfield()
    {
        return $this->customfield;
    }

    /**
     * Set emailaddress.
     *
     * @param string|null $emailaddress
     *
     * @return Users
     */
    public function setEmailaddress($emailaddress = null)
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }

    /**
     * Get emailaddress.
     *
     * @return string|null
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * Set hash.
     *
     * @param string|null $hash
     *
     * @return Users
     */
    public function setHash($hash = null)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash.
     *
     * @return string|null
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set salt.
     *
     * @param string|null $salt
     *
     * @return Users
     */
    public function setSalt($salt = null)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt.
     *
     * @return string|null
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Add notificationid.
     *
     * @param \PenD\Docker\Application\Model\Notifications $notificationid
     *
     * @return Users
     */
    public function addNotificationid(\PenD\Docker\Application\Model\Notifications $notificationid)
    {
        $this->notificationid[] = $notificationid;

        return $this;
    }

    /**
     * Remove notificationid.
     *
     * @param \PenD\Docker\Application\Model\Notifications $notificationid
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNotificationid(\PenD\Docker\Application\Model\Notifications $notificationid)
    {
        return $this->notificationid->removeElement($notificationid);
    }

    /**
     * Get notificationid.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNotificationid()
    {
        return $this->notificationid;
    }

    /**
     * Add zonefk.
     *
     * @param \PenD\Docker\Application\Model\Zones $zonefk
     *
     * @return Users
     */
    public function addZonefk(\PenD\Docker\Application\Model\Zones $zonefk)
    {
        $this->zonefk[] = $zonefk;

        return $this;
    }

    /**
     * Remove zonefk.
     *
     * @param \PenD\Docker\Application\Model\Zones $zonefk
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeZonefk(\PenD\Docker\Application\Model\Zones $zonefk)
    {
        return $this->zonefk->removeElement($zonefk);
    }

    /**
     * Get zonefk.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getZonefk()
    {
        return $this->zonefk;
    }
}
