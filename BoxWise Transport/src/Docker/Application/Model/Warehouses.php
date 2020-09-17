<?php

namespace PenD\Docker\Application\Model;

/**
 * Warehouses
 */
class Warehouses
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $warehousecode;

    /**
     * @var string
     */
    private $defaultinboundlocation;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set warehousecode.
     *
     * @param string $warehousecode
     *
     * @return Warehouses
     */
    public function setWarehousecode($warehousecode)
    {
        $this->warehousecode = $warehousecode;

        return $this;
    }

    /**
     * Get warehousecode.
     *
     * @return string
     */
    public function getWarehousecode()
    {
        return $this->warehousecode;
    }

    /**
     * Set defaultinboundlocation.
     *
     * @param string $defaultinboundlocation
     *
     * @return Warehouses
     */
    public function setDefaultinboundlocation($defaultinboundlocation)
    {
        $this->defaultinboundlocation = $defaultinboundlocation;

        return $this;
    }

    /**
     * Get defaultinboundlocation.
     *
     * @return string
     */
    public function getDefaultinboundlocation()
    {
        return $this->defaultinboundlocation;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Warehouses
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
     * @return Warehouses
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
     * @return Warehouses
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
     * @return Warehouses
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
     * @return Warehouses
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
