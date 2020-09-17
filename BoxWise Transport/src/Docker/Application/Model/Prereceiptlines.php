<?php

namespace PenD\Docker\Application\Model;

/**
 * Prereceiptlines
 */
class Prereceiptlines
{
    /**
     * @var int
     */
    private $prereceiptlinesPk;

    /**
     * @var string
     */
    private $itemcode;

    /**
     * @var string
     */
    private $itemdescription;

    /**
     * @var string
     */
    private $defaultvendoritemcode;

    /**
     * @var string|null
     */
    private $currentvendoritemcode;

    /**
     * @var string
     */
    private $purchaseordernumber;

    /**
     * @var int
     */
    private $purchaseorderid;

    /**
     * @var int
     */
    private $purchaseorderlineid;

    /**
     * @var int
     */
    private $purchaseorderlinenumber;

    /**
     * @var string
     */
    private $suppliername;

    /**
     * @var string
     */
    private $suppliercode;

    /**
     * @var bool
     */
    private $isbatchnumberitem = '0';

    /**
     * @var bool
     */
    private $isserialnumberitem = '0';

    /**
     * @var string
     */
    private $quantityordered;

    /**
     * @var string
     */
    private $quantitysupplierpackageslip;

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var string
     */
    private $unitcode;

    /**
     * @var string
     */
    private $warehousecode;

    /**
     * @var string
     */
    private $salesunitcode;

    /**
     * @var string
     */
    private $salesunitfactor;

    /**
     * @var string|null
     */
    private $lineinstruction;

    /**
     * @var string|null
     */
    private $linecurrencycode;

    /**
     * @var string
     */
    private $itempurchaseprice = '0';

    /**
     * @var string|null
     */
    private $customfields;

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
     * @var \PenD\Docker\Application\Model\Prereceipts
     */
    private $prereceiptFk;


    /**
     * Get prereceiptlinesPk.
     *
     * @return int
     */
    public function getPrereceiptlinesPk()
    {
        return $this->prereceiptlinesPk;
    }

    /**
     * Set itemcode.
     *
     * @param string $itemcode
     *
     * @return Prereceiptlines
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
     * @param string $itemdescription
     *
     * @return Prereceiptlines
     */
    public function setItemdescription($itemdescription)
    {
        $this->itemdescription = $itemdescription;

        return $this;
    }

    /**
     * Get itemdescription.
     *
     * @return string
     */
    public function getItemdescription()
    {
        return $this->itemdescription;
    }

    /**
     * Set defaultvendoritemcode.
     *
     * @param string $defaultvendoritemcode
     *
     * @return Prereceiptlines
     */
    public function setDefaultvendoritemcode($defaultvendoritemcode)
    {
        $this->defaultvendoritemcode = $defaultvendoritemcode;

        return $this;
    }

    /**
     * Get defaultvendoritemcode.
     *
     * @return string
     */
    public function getDefaultvendoritemcode()
    {
        return $this->defaultvendoritemcode;
    }

    /**
     * Set currentvendoritemcode.
     *
     * @param string|null $currentvendoritemcode
     *
     * @return Prereceiptlines
     */
    public function setCurrentvendoritemcode($currentvendoritemcode = null)
    {
        $this->currentvendoritemcode = $currentvendoritemcode;

        return $this;
    }

    /**
     * Get currentvendoritemcode.
     *
     * @return string|null
     */
    public function getCurrentvendoritemcode()
    {
        return $this->currentvendoritemcode;
    }

    /**
     * Set purchaseordernumber.
     *
     * @param string $purchaseordernumber
     *
     * @return Prereceiptlines
     */
    public function setPurchaseordernumber($purchaseordernumber)
    {
        $this->purchaseordernumber = $purchaseordernumber;

        return $this;
    }

    /**
     * Get purchaseordernumber.
     *
     * @return string
     */
    public function getPurchaseordernumber()
    {
        return $this->purchaseordernumber;
    }

    /**
     * Set purchaseorderid.
     *
     * @param int $purchaseorderid
     *
     * @return Prereceiptlines
     */
    public function setPurchaseorderid($purchaseorderid)
    {
        $this->purchaseorderid = $purchaseorderid;

        return $this;
    }

    /**
     * Get purchaseorderid.
     *
     * @return int
     */
    public function getPurchaseorderid()
    {
        return $this->purchaseorderid;
    }

    /**
     * Set purchaseorderlineid.
     *
     * @param int $purchaseorderlineid
     *
     * @return Prereceiptlines
     */
    public function setPurchaseorderlineid($purchaseorderlineid)
    {
        $this->purchaseorderlineid = $purchaseorderlineid;

        return $this;
    }

    /**
     * Get purchaseorderlineid.
     *
     * @return int
     */
    public function getPurchaseorderlineid()
    {
        return $this->purchaseorderlineid;
    }

    /**
     * Set purchaseorderlinenumber.
     *
     * @param int $purchaseorderlinenumber
     *
     * @return Prereceiptlines
     */
    public function setPurchaseorderlinenumber($purchaseorderlinenumber)
    {
        $this->purchaseorderlinenumber = $purchaseorderlinenumber;

        return $this;
    }

    /**
     * Get purchaseorderlinenumber.
     *
     * @return int
     */
    public function getPurchaseorderlinenumber()
    {
        return $this->purchaseorderlinenumber;
    }

    /**
     * Set suppliername.
     *
     * @param string $suppliername
     *
     * @return Prereceiptlines
     */
    public function setSuppliername($suppliername)
    {
        $this->suppliername = $suppliername;

        return $this;
    }

    /**
     * Get suppliername.
     *
     * @return string
     */
    public function getSuppliername()
    {
        return $this->suppliername;
    }

    /**
     * Set suppliercode.
     *
     * @param string $suppliercode
     *
     * @return Prereceiptlines
     */
    public function setSuppliercode($suppliercode)
    {
        $this->suppliercode = $suppliercode;

        return $this;
    }

    /**
     * Get suppliercode.
     *
     * @return string
     */
    public function getSuppliercode()
    {
        return $this->suppliercode;
    }

    /**
     * Set isbatchnumberitem.
     *
     * @param bool $isbatchnumberitem
     *
     * @return Prereceiptlines
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
     * @return Prereceiptlines
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
     * Set quantityordered.
     *
     * @param string $quantityordered
     *
     * @return Prereceiptlines
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
     * Set quantitysupplierpackageslip.
     *
     * @param string $quantitysupplierpackageslip
     *
     * @return Prereceiptlines
     */
    public function setQuantitysupplierpackageslip($quantitysupplierpackageslip)
    {
        $this->quantitysupplierpackageslip = $quantitysupplierpackageslip;

        return $this;
    }

    /**
     * Get quantitysupplierpackageslip.
     *
     * @return string
     */
    public function getQuantitysupplierpackageslip()
    {
        return $this->quantitysupplierpackageslip;
    }

    /**
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Prereceiptlines
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unitcode.
     *
     * @param string $unitcode
     *
     * @return Prereceiptlines
     */
    public function setUnitcode($unitcode)
    {
        $this->unitcode = $unitcode;

        return $this;
    }

    /**
     * Get unitcode.
     *
     * @return string
     */
    public function getUnitcode()
    {
        return $this->unitcode;
    }

    /**
     * Set warehousecode.
     *
     * @param string $warehousecode
     *
     * @return Prereceiptlines
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
     * Set salesunitcode.
     *
     * @param string $salesunitcode
     *
     * @return Prereceiptlines
     */
    public function setSalesunitcode($salesunitcode)
    {
        $this->salesunitcode = $salesunitcode;

        return $this;
    }

    /**
     * Get salesunitcode.
     *
     * @return string
     */
    public function getSalesunitcode()
    {
        return $this->salesunitcode;
    }

    /**
     * Set salesunitfactor.
     *
     * @param string $salesunitfactor
     *
     * @return Prereceiptlines
     */
    public function setSalesunitfactor($salesunitfactor)
    {
        $this->salesunitfactor = $salesunitfactor;

        return $this;
    }

    /**
     * Get salesunitfactor.
     *
     * @return string
     */
    public function getSalesunitfactor()
    {
        return $this->salesunitfactor;
    }

    /**
     * Set lineinstruction.
     *
     * @param string|null $lineinstruction
     *
     * @return Prereceiptlines
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
     * Set linecurrencycode.
     *
     * @param string|null $linecurrencycode
     *
     * @return Prereceiptlines
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
     * Set itempurchaseprice.
     *
     * @param string $itempurchaseprice
     *
     * @return Prereceiptlines
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
     * Set customfields.
     *
     * @param string|null $customfields
     *
     * @return Prereceiptlines
     */
    public function setCustomfields($customfields = null)
    {
        $this->customfields = $customfields;

        return $this;
    }

    /**
     * Get customfields.
     *
     * @return string|null
     */
    public function getCustomfields()
    {
        return $this->customfields;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Prereceiptlines
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
     * @return Prereceiptlines
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
     * @return Prereceiptlines
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
     * @return Prereceiptlines
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
     * @return Prereceiptlines
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
     * Set prereceiptFk.
     *
     * @param \PenD\Docker\Application\Model\Prereceipts|null $prereceiptFk
     *
     * @return Prereceiptlines
     */
    public function setPrereceiptFk(\PenD\Docker\Application\Model\Prereceipts $prereceiptFk = null)
    {
        $this->prereceiptFk = $prereceiptFk;

        return $this;
    }

    /**
     * Get prereceiptFk.
     *
     * @return \PenD\Docker\Application\Model\Prereceipts|null
     */
    public function getPrereceiptFk()
    {
        return $this->prereceiptFk;
    }
}
