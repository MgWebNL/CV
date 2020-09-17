<?php

namespace PenD\Docker\Application\Model;

/**
 * Batchitems
 */
class Batchitems
{
    /**
     * @var int
     */
    private $batchitemsPk;

    /**
     * @var int
     */
    private $batchesFk;

    /**
     * @var string|null
     */
    private $batchlocationtype;

    /**
     * @var string
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var string|null
     */
    private $itemidentificationnumber;

    /**
     * @var string|null
     */
    private $itemidentificationtype;

    /**
     * @var int
     */
    private $salesorderid;

    /**
     * @var \DateTime|null
     */
    private $salesordercreatedon;

    /**
     * @var int
     */
    private $salesorderlineid;

    /**
     * @var string|null
     */
    private $warehouseallocated;

    /**
     * @var string|null
     */
    private $warehouselocationallocated;

    /**
     * @var bool
     */
    private $differfromroute = '0';

    /**
     * @var string
     */
    private $quantityallocated = '0';

    /**
     * @var string
     */
    private $quantitypicked = '0';

    /**
     * @var string
     */
    private $quantitydifferfromroute = '0';

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
     * Get batchitemsPk.
     *
     * @return int
     */
    public function getBatchitemsPk()
    {
        return $this->batchitemsPk;
    }

    /**
     * Set batchesFk.
     *
     * @param int $batchesFk
     *
     * @return Batchitems
     */
    public function setBatchesFk($batchesFk)
    {
        $this->batchesFk = $batchesFk;

        return $this;
    }

    /**
     * Get batchesFk.
     *
     * @return int
     */
    public function getBatchesFk()
    {
        return $this->batchesFk;
    }

    /**
     * Set batchlocationtype.
     *
     * @param string|null $batchlocationtype
     *
     * @return Batchitems
     */
    public function setBatchlocationtype($batchlocationtype = null)
    {
        $this->batchlocationtype = $batchlocationtype;

        return $this;
    }

    /**
     * Get batchlocationtype.
     *
     * @return string|null
     */
    public function getBatchlocationtype()
    {
        return $this->batchlocationtype;
    }

    /**
     * Set itemcode.
     *
     * @param string $itemcode
     *
     * @return Batchitems
     */
    public function setItemcode($itemcode)
    {
        $this->itemcode = $itemcode;

        return $this;
    }

    /**
     * Get itemcode.
     *
     * @return string
     */
    public function getItemcode()
    {
        return $this->itemcode;
    }

    /**
     * Set itemdescription.
     *
     * @param string|null $itemdescription
     *
     * @return Batchitems
     */
    public function setItemdescription($itemdescription = null)
    {
        $this->itemdescription = $itemdescription;

        return $this;
    }

    /**
     * Get itemdescription.
     *
     * @return string|null
     */
    public function getItemdescription()
    {
        return $this->itemdescription;
    }

    /**
     * Set itemidentificationnumber.
     *
     * @param string|null $itemidentificationnumber
     *
     * @return Batchitems
     */
    public function setItemidentificationnumber($itemidentificationnumber = null)
    {
        $this->itemidentificationnumber = $itemidentificationnumber;

        return $this;
    }

    /**
     * Get itemidentificationnumber.
     *
     * @return string|null
     */
    public function getItemidentificationnumber()
    {
        return $this->itemidentificationnumber;
    }

    /**
     * Set itemidentificationtype.
     *
     * @param string|null $itemidentificationtype
     *
     * @return Batchitems
     */
    public function setItemidentificationtype($itemidentificationtype = null)
    {
        $this->itemidentificationtype = $itemidentificationtype;

        return $this;
    }

    /**
     * Get itemidentificationtype.
     *
     * @return string|null
     */
    public function getItemidentificationtype()
    {
        return $this->itemidentificationtype;
    }

    /**
     * Set salesorderid.
     *
     * @param int $salesorderid
     *
     * @return Batchitems
     */
    public function setSalesorderid($salesorderid)
    {
        $this->salesorderid = $salesorderid;

        return $this;
    }

    /**
     * Get salesorderid.
     *
     * @return int
     */
    public function getSalesorderid()
    {
        return $this->salesorderid;
    }

    /**
     * Set salesordercreatedon.
     *
     * @param \DateTime|null $salesordercreatedon
     *
     * @return Batchitems
     */
    public function setSalesordercreatedon($salesordercreatedon = null)
    {
        $this->salesordercreatedon = $salesordercreatedon;

        return $this;
    }

    /**
     * Get salesordercreatedon.
     *
     * @return \DateTime|null
     */
    public function getSalesordercreatedon()
    {
        return $this->salesordercreatedon;
    }

    /**
     * Set salesorderlineid.
     *
     * @param int $salesorderlineid
     *
     * @return Batchitems
     */
    public function setSalesorderlineid($salesorderlineid)
    {
        $this->salesorderlineid = $salesorderlineid;

        return $this;
    }

    /**
     * Get salesorderlineid.
     *
     * @return int
     */
    public function getSalesorderlineid()
    {
        return $this->salesorderlineid;
    }

    /**
     * Set warehouseallocated.
     *
     * @param string|null $warehouseallocated
     *
     * @return Batchitems
     */
    public function setWarehouseallocated($warehouseallocated = null)
    {
        $this->warehouseallocated = $warehouseallocated;

        return $this;
    }

    /**
     * Get warehouseallocated.
     *
     * @return string|null
     */
    public function getWarehouseallocated()
    {
        return $this->warehouseallocated;
    }

    /**
     * Set warehouselocationallocated.
     *
     * @param string|null $warehouselocationallocated
     *
     * @return Batchitems
     */
    public function setWarehouselocationallocated($warehouselocationallocated = null)
    {
        $this->warehouselocationallocated = $warehouselocationallocated;

        return $this;
    }

    /**
     * Get warehouselocationallocated.
     *
     * @return string|null
     */
    public function getWarehouselocationallocated()
    {
        return $this->warehouselocationallocated;
    }

    /**
     * Set differfromroute.
     *
     * @param bool $differfromroute
     *
     * @return Batchitems
     */
    public function setDifferfromroute($differfromroute)
    {
        $this->differfromroute = $differfromroute;

        return $this;
    }

    /**
     * Get differfromroute.
     *
     * @return bool
     */
    public function getDifferfromroute()
    {
        return $this->differfromroute;
    }

    /**
     * Set quantityallocated.
     *
     * @param string $quantityallocated
     *
     * @return Batchitems
     */
    public function setQuantityallocated($quantityallocated)
    {
        $this->quantityallocated = $quantityallocated;

        return $this;
    }

    /**
     * Get quantityallocated.
     *
     * @return string
     */
    public function getQuantityallocated()
    {
        return $this->quantityallocated;
    }

    /**
     * Set quantitypicked.
     *
     * @param string $quantitypicked
     *
     * @return Batchitems
     */
    public function setQuantitypicked($quantitypicked)
    {
        $this->quantitypicked = $quantitypicked;

        return $this;
    }

    /**
     * Get quantitypicked.
     *
     * @return string
     */
    public function getQuantitypicked()
    {
        return $this->quantitypicked;
    }

    /**
     * Set quantitydifferfromroute.
     *
     * @param string $quantitydifferfromroute
     *
     * @return Batchitems
     */
    public function setQuantitydifferfromroute($quantitydifferfromroute)
    {
        $this->quantitydifferfromroute = $quantitydifferfromroute;

        return $this;
    }

    /**
     * Get quantitydifferfromroute.
     *
     * @return string
     */
    public function getQuantitydifferfromroute()
    {
        return $this->quantitydifferfromroute;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Batchitems
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
     * @return Batchitems
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
     * @return Batchitems
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
     * @return Batchitems
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
     * @return Batchitems
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
