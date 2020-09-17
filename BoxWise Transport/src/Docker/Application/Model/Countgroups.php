<?php

namespace PenD\Docker\Application\Model;

/**
 * Countgroups
 */
class Countgroups
{
    /**
     * @var int
     */
    private $countgroupsPk;

    /**
     * @var int|null
     */
    private $storageassignmentclassificationsFk;

    /**
     * @var bool
     */
    private $system;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var bool
     */
    private $usescript = '0';

    /**
     * @var string|null
     */
    private $script;

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
     * Get countgroupsPk.
     *
     * @return int
     */
    public function getCountgroupsPk()
    {
        return $this->countgroupsPk;
    }

    /**
     * Set storageassignmentclassificationsFk.
     *
     * @param int|null $storageassignmentclassificationsFk
     *
     * @return Countgroups
     */
    public function setStorageassignmentclassificationsFk($storageassignmentclassificationsFk = null)
    {
        $this->storageassignmentclassificationsFk = $storageassignmentclassificationsFk;

        return $this;
    }

    /**
     * Get storageassignmentclassificationsFk.
     *
     * @return int|null
     */
    public function getStorageassignmentclassificationsFk()
    {
        return $this->storageassignmentclassificationsFk;
    }

    /**
     * Set system.
     *
     * @param bool $system
     *
     * @return Countgroups
     */
    public function setSystem($system)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system.
     *
     * @return bool
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Countgroups
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
     * Set code.
     *
     * @param string|null $code
     *
     * @return Countgroups
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Countgroups
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
     * Set usescript.
     *
     * @param bool $usescript
     *
     * @return Countgroups
     */
    public function setUsescript($usescript)
    {
        $this->usescript = $usescript;

        return $this;
    }

    /**
     * Get usescript.
     *
     * @return bool
     */
    public function getUsescript()
    {
        return $this->usescript;
    }

    /**
     * Set script.
     *
     * @param string|null $script
     *
     * @return Countgroups
     */
    public function setScript($script = null)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script.
     *
     * @return string|null
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Countgroups
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
     * @return Countgroups
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
     * @return Countgroups
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
     * @return Countgroups
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
     * @return Countgroups
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
