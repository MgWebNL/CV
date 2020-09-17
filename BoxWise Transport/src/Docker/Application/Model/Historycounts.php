<?php

namespace PenD\Docker\Application\Model;

/**
 * Historycounts
 */
class Historycounts
{
    /**
     * @var int
     */
    private $historycountPk;

    /**
     * @var int
     */
    private $countPk;

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
     * @var string|null
     */
    private $itemunitcode;

    /**
     * @var string|null
     */
    private $itemid;

    /**
     * @var string
     */
    private $stock;

    /**
     * @var string
     */
    private $absolutevalue;

    /**
     * @var bool
     */
    private $ismanuallymodified = '0';

    /**
     * @var string|null
     */
    private $erpdescription;

    /**
     * @var \DateTime|null
     */
    private $erpdate;

    /**
     * @var int|null
     */
    private $erpcountid;

    /**
     * @var string|null
     */
    private $erpnewstock;

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
     * Get historycountPk.
     *
     * @return int
     */
    public function getHistorycountPk()
    {
        return $this->historycountPk;
    }

    /**
     * Set countPk.
     *
     * @param int $countPk
     *
     * @return Historycounts
     */
    public function setCountPk($countPk)
    {
        $this->countPk = $countPk;

        return $this;
    }

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
     * Set counttype.
     *
     * @param string $counttype
     *
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @param string|null $itemunitcode
     *
     * @return Historycounts
     */
    public function setItemunitcode($itemunitcode = null)
    {
        $this->itemunitcode = $itemunitcode;

        return $this;
    }

    /**
     * Get itemunitcode.
     *
     * @return string|null
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * Set erpdescription.
     *
     * @param string|null $erpdescription
     *
     * @return Historycounts
     */
    public function setErpdescription($erpdescription = null)
    {
        $this->erpdescription = $erpdescription;

        return $this;
    }

    /**
     * Get erpdescription.
     *
     * @return string|null
     */
    public function getErpdescription()
    {
        return $this->erpdescription;
    }

    /**
     * Set erpdate.
     *
     * @param \DateTime|null $erpdate
     *
     * @return Historycounts
     */
    public function setErpdate($erpdate = null)
    {
        $this->erpdate = $erpdate;

        return $this;
    }

    /**
     * Get erpdate.
     *
     * @return \DateTime|null
     */
    public function getErpdate()
    {
        return $this->erpdate;
    }

    /**
     * Set erpcountid.
     *
     * @param int|null $erpcountid
     *
     * @return Historycounts
     */
    public function setErpcountid($erpcountid = null)
    {
        $this->erpcountid = $erpcountid;

        return $this;
    }

    /**
     * Get erpcountid.
     *
     * @return int|null
     */
    public function getErpcountid()
    {
        return $this->erpcountid;
    }

    /**
     * Set erpnewstock.
     *
     * @param string|null $erpnewstock
     *
     * @return Historycounts
     */
    public function setErpnewstock($erpnewstock = null)
    {
        $this->erpnewstock = $erpnewstock;

        return $this;
    }

    /**
     * Get erpnewstock.
     *
     * @return string|null
     */
    public function getErpnewstock()
    {
        return $this->erpnewstock;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
     * @return Historycounts
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
