<?php

namespace PenD\Docker\Application\Model;

/**
 * Replenishmentorderlines
 */
class Replenishmentorderlines
{
    /**
     * @var int
     */
    private $replenishmentorderlinePk;

    /**
     * @var int
     */
    private $linenumber = '-1';

    /**
     * @var string|null
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $warehouse;

    /**
     * @var string|null
     */
    private $customeritemcode;

    /**
     * @var string|null
     */
    private $customername;

    /**
     * @var string|null
     */
    private $defaultvendoritemcode;

    /**
     * @var string|null
     */
    private $defaultvendorbarcode;

    /**
     * @var string
     */
    private $quantityordered = '0';

    /**
     * @var string
     */
    private $quantitydelivered = '0';

    /**
     * @var string
     */
    private $quantitytodeliver = '0';

    /**
     * @var \DateTime|null
     */
    private $linedateofdelivery;

    /**
     * @var string|null
     */
    private $lineinstruction;

    /**
     * @var string|null
     */
    private $linedescription;

    /**
     * @var bool
     */
    private $isbatchnumberitem = '0';

    /**
     * @var bool
     */
    private $isserialnumberitem = '0';

    /**
     * @var string|null
     */
    private $lineitemidentifier;

    /**
     * @var string
     */
    private $itemweight = '0';

    /**
     * @var string|null
     */
    private $itemlongdescription;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var string|null
     */
    private $itembrand;

    /**
     * @var string|null
     */
    private $linecurrencycode;

    /**
     * @var string
     */
    private $itemsalesprice = '0';

    /**
     * @var string
     */
    private $itempurchaseprice = '0';

    /**
     * @var string
     */
    private $itemsalespricewithvat = '0';

    /**
     * @var bool|null
     */
    private $isfractionallowed;

    /**
     * @var string|null
     */
    private $itemidregistration;

    /**
     * @var string|null
     */
    private $unitcode;

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
     * @var \PenD\Docker\Application\Model\Replenishmentorders
     */
    private $replenishmentordersFk;


    /**
     * Get replenishmentorderlinePk.
     *
     * @return int
     */
    public function getReplenishmentorderlinePk()
    {
        return $this->replenishmentorderlinePk;
    }

    /**
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Replenishmentorderlines
     */
    public function setLinenumber($linenumber)
    {
        $this->linenumber = $linenumber;

        return $this;
    }

    /**
     * Get linenumber.
     *
     * @return int
     */
    public function getLinenumber()
    {
        return $this->linenumber;
    }

    /**
     * Set itemcode.
     *
     * @param string|null $itemcode
     *
     * @return Replenishmentorderlines
     */
    public function setItemcode($itemcode = null)
    {
        $this->itemcode = $itemcode;

        return $this;
    }

    /**
     * Get itemcode.
     *
     * @return string|null
     */
    public function getItemcode()
    {
        return $this->itemcode;
    }

    /**
     * Set warehouse.
     *
     * @param string|null $warehouse
     *
     * @return Replenishmentorderlines
     */
    public function setWarehouse($warehouse = null)
    {
        $this->warehouse = $warehouse;

        return $this;
    }

    /**
     * Get warehouse.
     *
     * @return string|null
     */
    public function getWarehouse()
    {
        return $this->warehouse;
    }

    /**
     * Set customeritemcode.
     *
     * @param string|null $customeritemcode
     *
     * @return Replenishmentorderlines
     */
    public function setCustomeritemcode($customeritemcode = null)
    {
        $this->customeritemcode = $customeritemcode;

        return $this;
    }

    /**
     * Get customeritemcode.
     *
     * @return string|null
     */
    public function getCustomeritemcode()
    {
        return $this->customeritemcode;
    }

    /**
     * Set customername.
     *
     * @param string|null $customername
     *
     * @return Replenishmentorderlines
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
     * Set defaultvendoritemcode.
     *
     * @param string|null $defaultvendoritemcode
     *
     * @return Replenishmentorderlines
     */
    public function setDefaultvendoritemcode($defaultvendoritemcode = null)
    {
        $this->defaultvendoritemcode = $defaultvendoritemcode;

        return $this;
    }

    /**
     * Get defaultvendoritemcode.
     *
     * @return string|null
     */
    public function getDefaultvendoritemcode()
    {
        return $this->defaultvendoritemcode;
    }

    /**
     * Set defaultvendorbarcode.
     *
     * @param string|null $defaultvendorbarcode
     *
     * @return Replenishmentorderlines
     */
    public function setDefaultvendorbarcode($defaultvendorbarcode = null)
    {
        $this->defaultvendorbarcode = $defaultvendorbarcode;

        return $this;
    }

    /**
     * Get defaultvendorbarcode.
     *
     * @return string|null
     */
    public function getDefaultvendorbarcode()
    {
        return $this->defaultvendorbarcode;
    }

    /**
     * Set quantityordered.
     *
     * @param string $quantityordered
     *
     * @return Replenishmentorderlines
     */
    public function setQuantityordered($quantityordered)
    {
        $this->quantityordered = $quantityordered;

        return $this;
    }

    /**
     * Get quantityordered.
     *
     * @return string
     */
    public function getQuantityordered()
    {
        return $this->quantityordered;
    }

    /**
     * Set quantitydelivered.
     *
     * @param string $quantitydelivered
     *
     * @return Replenishmentorderlines
     */
    public function setQuantitydelivered($quantitydelivered)
    {
        $this->quantitydelivered = $quantitydelivered;

        return $this;
    }

    /**
     * Get quantitydelivered.
     *
     * @return string
     */
    public function getQuantitydelivered()
    {
        return $this->quantitydelivered;
    }

    /**
     * Set quantitytodeliver.
     *
     * @param string $quantitytodeliver
     *
     * @return Replenishmentorderlines
     */
    public function setQuantitytodeliver($quantitytodeliver)
    {
        $this->quantitytodeliver = $quantitytodeliver;

        return $this;
    }

    /**
     * Get quantitytodeliver.
     *
     * @return string
     */
    public function getQuantitytodeliver()
    {
        return $this->quantitytodeliver;
    }

    /**
     * Set linedateofdelivery.
     *
     * @param \DateTime|null $linedateofdelivery
     *
     * @return Replenishmentorderlines
     */
    public function setLinedateofdelivery($linedateofdelivery = null)
    {
        $this->linedateofdelivery = $linedateofdelivery;

        return $this;
    }

    /**
     * Get linedateofdelivery.
     *
     * @return \DateTime|null
     */
    public function getLinedateofdelivery()
    {
        return $this->linedateofdelivery;
    }

    /**
     * Set lineinstruction.
     *
     * @param string|null $lineinstruction
     *
     * @return Replenishmentorderlines
     */
    public function setLineinstruction($lineinstruction = null)
    {
        $this->lineinstruction = $lineinstruction;

        return $this;
    }

    /**
     * Get lineinstruction.
     *
     * @return string|null
     */
    public function getLineinstruction()
    {
        return $this->lineinstruction;
    }

    /**
     * Set linedescription.
     *
     * @param string|null $linedescription
     *
     * @return Replenishmentorderlines
     */
    public function setLinedescription($linedescription = null)
    {
        $this->linedescription = $linedescription;

        return $this;
    }

    /**
     * Get linedescription.
     *
     * @return string|null
     */
    public function getLinedescription()
    {
        return $this->linedescription;
    }

    /**
     * Set isbatchnumberitem.
     *
     * @param bool $isbatchnumberitem
     *
     * @return Replenishmentorderlines
     */
    public function setIsbatchnumberitem($isbatchnumberitem)
    {
        $this->isbatchnumberitem = $isbatchnumberitem;

        return $this;
    }

    /**
     * Get isbatchnumberitem.
     *
     * @return bool
     */
    public function getIsbatchnumberitem()
    {
        return $this->isbatchnumberitem;
    }

    /**
     * Set isserialnumberitem.
     *
     * @param bool $isserialnumberitem
     *
     * @return Replenishmentorderlines
     */
    public function setIsserialnumberitem($isserialnumberitem)
    {
        $this->isserialnumberitem = $isserialnumberitem;

        return $this;
    }

    /**
     * Get isserialnumberitem.
     *
     * @return bool
     */
    public function getIsserialnumberitem()
    {
        return $this->isserialnumberitem;
    }

    /**
     * Set lineitemidentifier.
     *
     * @param string|null $lineitemidentifier
     *
     * @return Replenishmentorderlines
     */
    public function setLineitemidentifier($lineitemidentifier = null)
    {
        $this->lineitemidentifier = $lineitemidentifier;

        return $this;
    }

    /**
     * Get lineitemidentifier.
     *
     * @return string|null
     */
    public function getLineitemidentifier()
    {
        return $this->lineitemidentifier;
    }

    /**
     * Set itemweight.
     *
     * @param string $itemweight
     *
     * @return Replenishmentorderlines
     */
    public function setItemweight($itemweight)
    {
        $this->itemweight = $itemweight;

        return $this;
    }

    /**
     * Get itemweight.
     *
     * @return string
     */
    public function getItemweight()
    {
        return $this->itemweight;
    }

    /**
     * Set itemlongdescription.
     *
     * @param string|null $itemlongdescription
     *
     * @return Replenishmentorderlines
     */
    public function setItemlongdescription($itemlongdescription = null)
    {
        $this->itemlongdescription = $itemlongdescription;

        return $this;
    }

    /**
     * Get itemlongdescription.
     *
     * @return string|null
     */
    public function getItemlongdescription()
    {
        return $this->itemlongdescription;
    }

    /**
     * Set itemdescription.
     *
     * @param string|null $itemdescription
     *
     * @return Replenishmentorderlines
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
     * Set itembrand.
     *
     * @param string|null $itembrand
     *
     * @return Replenishmentorderlines
     */
    public function setItembrand($itembrand = null)
    {
        $this->itembrand = $itembrand;

        return $this;
    }

    /**
     * Get itembrand.
     *
     * @return string|null
     */
    public function getItembrand()
    {
        return $this->itembrand;
    }

    /**
     * Set linecurrencycode.
     *
     * @param string|null $linecurrencycode
     *
     * @return Replenishmentorderlines
     */
    public function setLinecurrencycode($linecurrencycode = null)
    {
        $this->linecurrencycode = $linecurrencycode;

        return $this;
    }

    /**
     * Get linecurrencycode.
     *
     * @return string|null
     */
    public function getLinecurrencycode()
    {
        return $this->linecurrencycode;
    }

    /**
     * Set itemsalesprice.
     *
     * @param string $itemsalesprice
     *
     * @return Replenishmentorderlines
     */
    public function setItemsalesprice($itemsalesprice)
    {
        $this->itemsalesprice = $itemsalesprice;

        return $this;
    }

    /**
     * Get itemsalesprice.
     *
     * @return string
     */
    public function getItemsalesprice()
    {
        return $this->itemsalesprice;
    }

    /**
     * Set itempurchaseprice.
     *
     * @param string $itempurchaseprice
     *
     * @return Replenishmentorderlines
     */
    public function setItempurchaseprice($itempurchaseprice)
    {
        $this->itempurchaseprice = $itempurchaseprice;

        return $this;
    }

    /**
     * Get itempurchaseprice.
     *
     * @return string
     */
    public function getItempurchaseprice()
    {
        return $this->itempurchaseprice;
    }

    /**
     * Set itemsalespricewithvat.
     *
     * @param string $itemsalespricewithvat
     *
     * @return Replenishmentorderlines
     */
    public function setItemsalespricewithvat($itemsalespricewithvat)
    {
        $this->itemsalespricewithvat = $itemsalespricewithvat;

        return $this;
    }

    /**
     * Get itemsalespricewithvat.
     *
     * @return string
     */
    public function getItemsalespricewithvat()
    {
        return $this->itemsalespricewithvat;
    }

    /**
     * Set isfractionallowed.
     *
     * @param bool|null $isfractionallowed
     *
     * @return Replenishmentorderlines
     */
    public function setIsfractionallowed($isfractionallowed = null)
    {
        $this->isfractionallowed = $isfractionallowed;

        return $this;
    }

    /**
     * Get isfractionallowed.
     *
     * @return bool|null
     */
    public function getIsfractionallowed()
    {
        return $this->isfractionallowed;
    }

    /**
     * Set itemidregistration.
     *
     * @param string|null $itemidregistration
     *
     * @return Replenishmentorderlines
     */
    public function setItemidregistration($itemidregistration = null)
    {
        $this->itemidregistration = $itemidregistration;

        return $this;
    }

    /**
     * Get itemidregistration.
     *
     * @return string|null
     */
    public function getItemidregistration()
    {
        return $this->itemidregistration;
    }

    /**
     * Set unitcode.
     *
     * @param string|null $unitcode
     *
     * @return Replenishmentorderlines
     */
    public function setUnitcode($unitcode = null)
    {
        $this->unitcode = $unitcode;

        return $this;
    }

    /**
     * Get unitcode.
     *
     * @return string|null
     */
    public function getUnitcode()
    {
        return $this->unitcode;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Replenishmentorderlines
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
     * @return Replenishmentorderlines
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
     * @return Replenishmentorderlines
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
     * @return Replenishmentorderlines
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
     * @return Replenishmentorderlines
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
     * Set replenishmentordersFk.
     *
     * @param \PenD\Docker\Application\Model\Replenishmentorders|null $replenishmentordersFk
     *
     * @return Replenishmentorderlines
     */
    public function setReplenishmentordersFk(\PenD\Docker\Application\Model\Replenishmentorders $replenishmentordersFk = null)
    {
        $this->replenishmentordersFk = $replenishmentordersFk;

        return $this;
    }

    /**
     * Get replenishmentordersFk.
     *
     * @return \PenD\Docker\Application\Model\Replenishmentorders|null
     */
    public function getReplenishmentordersFk()
    {
        return $this->replenishmentordersFk;
    }
}
