<?php

namespace PenD\Docker\Application\Model;

/**
 * Counts
 */
class Counts
{
    /**
     * @var int
     */
    private $countPk;

    /**
     * @var int|null
     */
    private $countgroupsFk;

    /**
     * @var string
     */
    private $counttype;

    /**
     * @var string
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var bool
     */
    private $isserialitem = '0';

    /**
     * @var bool
     */
    private $isbatchitem = '0';

    /**
     * @var string
     */
    private $itemidregistration = 'Complete';

    /**
     * @var string
     */
    private $warehousecode = '';

    /**
     * @var string|null
     */
    private $warehouselocationcode;

    /**
     * @var string
     */
    private $itemdefaultcostprice = '0';

    /**
     * @var bool
     */
    private $itemallowsfraction = '0';

    /**
     * @var string
     */
    private $itemunitcode;

    /**
     * @var string|null
     */
    private $itemid;

    /**
     * @var string
     */
    private $stock = '0';

    /**
     * @var string
     */
    private $absolutevalue = '0';

    /**
     * @var bool
     */
    private $ismanuallymodified = '0';

    /**
     * @var string|null
     */
    private $erperrors;

    /**
     * @var \DateTime|null
     */
    private $enddate;

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
    private $difference;


    /**
     * Get countPk.
     *
     * @return int
     */
    public function getCountPk()
    {
        return $this->countPk;
    }

    /**
     * Set countgroupsFk.
     *
     * @param int|null $countgroupsFk
     *
     * @return Counts
     */
    public function setCountgroupsFk($countgroupsFk = null)
    {
        $this->countgroupsFk = $countgroupsFk;

        return $this;
    }

    /**
     * Get countgroupsFk.
     *
     * @return int|null
     */
    public function getCountgroupsFk()
    {
        return $this->countgroupsFk;
    }

    /**
     * Set counttype.
     *
     * @param string $counttype
     *
     * @return Counts
     */
    public function setCounttype($counttype)
    {
        $this->counttype = $counttype;

        return $this;
    }

    /**
     * Get counttype.
     *
     * @return string
     */
    public function getCounttype()
    {
        return $this->counttype;
    }

    /**
     * Set itemcode.
     *
     * @param string $itemcode
     *
     * @return Counts
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
     * @return Counts
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
     * Set isserialitem.
     *
     * @param bool $isserialitem
     *
     * @return Counts
     */
    public function setIsserialitem($isserialitem)
    {
        $this->isserialitem = $isserialitem;

        return $this;
    }

    /**
     * Get isserialitem.
     *
     * @return bool
     */
    public function getIsserialitem()
    {
        return $this->isserialitem;
    }

    /**
     * Set isbatchitem.
     *
     * @param bool $isbatchitem
     *
     * @return Counts
     */
    public function setIsbatchitem($isbatchitem)
    {
        $this->isbatchitem = $isbatchitem;

        return $this;
    }

    /**
     * Get isbatchitem.
     *
     * @return bool
     */
    public function getIsbatchitem()
    {
        return $this->isbatchitem;
    }

    /**
     * Set itemidregistration.
     *
     * @param string $itemidregistration
     *
     * @return Counts
     */
    public function setItemidregistration($itemidregistration)
    {
        $this->itemidregistration = $itemidregistration;

        return $this;
    }

    /**
     * Get itemidregistration.
     *
     * @return string
     */
    public function getItemidregistration()
    {
        return $this->itemidregistration;
    }

    /**
     * Set warehousecode.
     *
     * @param string $warehousecode
     *
     * @return Counts
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
     * Set warehouselocationcode.
     *
     * @param string|null $warehouselocationcode
     *
     * @return Counts
     */
    public function setWarehouselocationcode($warehouselocationcode = null)
    {
        $this->warehouselocationcode = $warehouselocationcode;

        return $this;
    }

    /**
     * Get warehouselocationcode.
     *
     * @return string|null
     */
    public function getWarehouselocationcode()
    {
        return $this->warehouselocationcode;
    }

    /**
     * Set itemdefaultcostprice.
     *
     * @param string $itemdefaultcostprice
     *
     * @return Counts
     */
    public function setItemdefaultcostprice($itemdefaultcostprice)
    {
        $this->itemdefaultcostprice = $itemdefaultcostprice;

        return $this;
    }

    /**
     * Get itemdefaultcostprice.
     *
     * @return string
     */
    public function getItemdefaultcostprice()
    {
        return $this->itemdefaultcostprice;
    }

    /**
     * Set itemallowsfraction.
     *
     * @param bool $itemallowsfraction
     *
     * @return Counts
     */
    public function setItemallowsfraction($itemallowsfraction)
    {
        $this->itemallowsfraction = $itemallowsfraction;

        return $this;
    }

    /**
     * Get itemallowsfraction.
     *
     * @return bool
     */
    public function getItemallowsfraction()
    {
        return $this->itemallowsfraction;
    }

    /**
     * Set itemunitcode.
     *
     * @param string $itemunitcode
     *
     * @return Counts
     */
    public function setItemunitcode($itemunitcode)
    {
        $this->itemunitcode = $itemunitcode;

        return $this;
    }

    /**
     * Get itemunitcode.
     *
     * @return string
     */
    public function getItemunitcode()
    {
        return $this->itemunitcode;
    }

    /**
     * Set itemid.
     *
     * @param string|null $itemid
     *
     * @return Counts
     */
    public function setItemid($itemid = null)
    {
        $this->itemid = $itemid;

        return $this;
    }

    /**
     * Get itemid.
     *
     * @return string|null
     */
    public function getItemid()
    {
        return $this->itemid;
    }

    /**
     * Set stock.
     *
     * @param string $stock
     *
     * @return Counts
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return string
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set absolutevalue.
     *
     * @param string $absolutevalue
     *
     * @return Counts
     */
    public function setAbsolutevalue($absolutevalue)
    {
        $this->absolutevalue = $absolutevalue;

        return $this;
    }

    /**
     * Get absolutevalue.
     *
     * @return string
     */
    public function getAbsolutevalue()
    {
        return $this->absolutevalue;
    }

    /**
     * Set ismanuallymodified.
     *
     * @param bool $ismanuallymodified
     *
     * @return Counts
     */
    public function setIsmanuallymodified($ismanuallymodified)
    {
        $this->ismanuallymodified = $ismanuallymodified;

        return $this;
    }

    /**
     * Get ismanuallymodified.
     *
     * @return bool
     */
    public function getIsmanuallymodified()
    {
        return $this->ismanuallymodified;
    }

    /**
     * Set erperrors.
     *
     * @param string|null $erperrors
     *
     * @return Counts
     */
    public function setErperrors($erperrors = null)
    {
        $this->erperrors = $erperrors;

        return $this;
    }

    /**
     * Get erperrors.
     *
     * @return string|null
     */
    public function getErperrors()
    {
        return $this->erperrors;
    }

    /**
     * Set enddate.
     *
     * @param \DateTime|null $enddate
     *
     * @return Counts
     */
    public function setEnddate($enddate = null)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate.
     *
     * @return \DateTime|null
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Counts
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
     * @return Counts
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
     * @return Counts
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
     * @return Counts
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
     * @return Counts
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
     * Set difference.
     *
     * @param string|null $difference
     *
     * @return Counts
     */
    public function setDifference($difference = null)
    {
        $this->difference = $difference;

        return $this;
    }

    /**
     * Get difference.
     *
     * @return string|null
     */
    public function getDifference()
    {
        return $this->difference;
    }
}
