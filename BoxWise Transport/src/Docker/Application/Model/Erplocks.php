<?php

namespace PenD\Docker\Application\Model;

/**
 * Erplocks
 */
class Erplocks
{
    /**
     * @var int
     */
    private $erplockPk;

    /**
     * @var string|null
     */
    private $entitytype;

    /**
     * @var string|null
     */
    private $entitykey;

    /**
     * @var string|null
     */
    private $currentstate;

    /**
     * @var string|null
     */
    private $migratetostate;

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
     * Get erplockPk.
     *
     * @return int
     */
    public function getErplockPk()
    {
        return $this->erplockPk;
    }

    /**
     * Set entitytype.
     *
     * @param string|null $entitytype
     *
     * @return Erplocks
     */
    public function setEntitytype($entitytype = null)
    {
        $this->entitytype = $entitytype;

        return $this;
    }

    /**
     * Get entitytype.
     *
     * @return string|null
     */
    public function getEntitytype()
    {
        return $this->entitytype;
    }

    /**
     * Set entitykey.
     *
     * @param string|null $entitykey
     *
     * @return Erplocks
     */
    public function setEntitykey($entitykey = null)
    {
        $this->entitykey = $entitykey;

        return $this;
    }

    /**
     * Get entitykey.
     *
     * @return string|null
     */
    public function getEntitykey()
    {
        return $this->entitykey;
    }

    /**
     * Set currentstate.
     *
     * @param string|null $currentstate
     *
     * @return Erplocks
     */
    public function setCurrentstate($currentstate = null)
    {
        $this->currentstate = $currentstate;

        return $this;
    }

    /**
     * Get currentstate.
     *
     * @return string|null
     */
    public function getCurrentstate()
    {
        return $this->currentstate;
    }

    /**
     * Set migratetostate.
     *
     * @param string|null $migratetostate
     *
     * @return Erplocks
     */
    public function setMigratetostate($migratetostate = null)
    {
        $this->migratetostate = $migratetostate;

        return $this;
    }

    /**
     * Get migratetostate.
     *
     * @return string|null
     */
    public function getMigratetostate()
    {
        return $this->migratetostate;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Erplocks
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
     * @return Erplocks
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
     * @return Erplocks
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
     * @return Erplocks
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
     * @return Erplocks
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
