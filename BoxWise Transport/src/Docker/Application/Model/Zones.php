<?php

namespace PenD\Docker\Application\Model;

/**
 * Zones
 */
class Zones
{
    /**
     * @var int
     */
    private $zonepk;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var bool
     */
    private $active = '0';

    /**
     * @var string|null
     */
    private $rights;

    /**
     * @var bool
     */
    private $sys = '0';

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $userfk;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userfk = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get zonepk.
     *
     * @return int
     */
    public function getZonepk()
    {
        return $this->zonepk;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Zones
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
     * @return Zones
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Zones
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
     * Set rights.
     *
     * @param string|null $rights
     *
     * @return Zones
     */
    public function setRights($rights = null)
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * Get rights.
     *
     * @return string|null
     */
    public function getRights()
    {
        return $this->rights;
    }

    /**
     * Set sys.
     *
     * @param bool $sys
     *
     * @return Zones
     */
    public function setSys($sys)
    {
        $this->sys = $sys;

        return $this;
    }

    /**
     * Get sys.
     *
     * @return bool
     */
    public function getSys()
    {
        return $this->sys;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Zones
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
     * @return Zones
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
     * @return Zones
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
     * @return Zones
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
     * @return Zones
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
     * Add userfk.
     *
     * @param \PenD\Docker\Application\Model\Users $userfk
     *
     * @return Zones
     */
    public function addUserfk(\PenD\Docker\Application\Model\Users $userfk)
    {
        $this->userfk[] = $userfk;

        return $this;
    }

    /**
     * Remove userfk.
     *
     * @param \PenD\Docker\Application\Model\Users $userfk
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserfk(\PenD\Docker\Application\Model\Users $userfk)
    {
        return $this->userfk->removeElement($userfk);
    }

    /**
     * Get userfk.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserfk()
    {
        return $this->userfk;
    }
}
