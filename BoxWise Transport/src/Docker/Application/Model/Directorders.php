<?php

namespace PenD\Docker\Application\Model;

/**
 * Directorders
 */
class Directorders
{
    /**
     * @var int
     */
    private $directordersPk;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $orderdate;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var string
     */
    private $customernumber;

    /**
     * @var string|null
     */
    private $customername;

    /**
     * @var string
     */
    private $warehousecode;

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
    private $erpid;


    /**
     * Get directordersPk.
     *
     * @return int
     */
    public function getDirectordersPk()
    {
        return $this->directordersPk;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return Directorders
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderdate.
     *
     * @param \DateTime $orderdate
     *
     * @return Directorders
     */
    public function setOrderdate($orderdate)
    {
        $this->orderdate = $orderdate;

        return $this;
    }

    /**
     * Get orderdate.
     *
     * @return \DateTime
     */
    public function getOrderdate()
    {
        return $this->orderdate;
    }

    /**
     * Set reference.
     *
     * @param string $reference
     *
     * @return Directorders
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set customernumber.
     *
     * @param string $customernumber
     *
     * @return Directorders
     */
    public function setCustomernumber($customernumber)
    {
        $this->customernumber = $customernumber;

        return $this;
    }

    /**
     * Get customernumber.
     *
     * @return string
     */
    public function getCustomernumber()
    {
        return $this->customernumber;
    }

    /**
     * Set customername.
     *
     * @param string|null $customername
     *
     * @return Directorders
     */
    public function setCustomername($customername = null)
    {
        $this->customername = $customername;

        return $this;
    }

    /**
     * Get customername.
     *
     * @return string|null
     */
    public function getCustomername()
    {
        return $this->customername;
    }

    /**
     * Set warehousecode.
     *
     * @param string $warehousecode
     *
     * @return Directorders
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Directorders
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
     * @return Directorders
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
     * @return Directorders
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
     * @return Directorders
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
     * @return Directorders
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
     * Set erpid.
     *
     * @param string|null $erpid
     *
     * @return Directorders
     */
    public function setErpid($erpid = null)
    {
        $this->erpid = $erpid;

        return $this;
    }

    /**
     * Get erpid.
     *
     * @return string|null
     */
    public function getErpid()
    {
        return $this->erpid;
    }
}
