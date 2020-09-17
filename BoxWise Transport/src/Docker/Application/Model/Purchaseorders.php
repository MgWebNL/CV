<?php

namespace PenD\Docker\Application\Model;

/**
 * Purchaseorders
 */
class Purchaseorders
{
    /**
     * @var int
     */
    private $purchaseordersPk;

    /**
     * @var string|null
     */
    private $groupguid;

    /**
     * @var string|null
     */
    private $erpid;

    /**
     * @var int
     */
    private $purchaseorderid = '-1';

    /**
     * @var string|null
     */
    private $ordernumber;

    /**
     * @var string|null
     */
    private $yourreference;

    /**
     * @var \DateTime|null
     */
    private $dateordered;

    /**
     * @var \DateTime|null
     */
    private $datefirstexpected;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $projectcode;

    /**
     * @var string|null
     */
    private $projectname;

    /**
     * @var string|null
     */
    private $businessunit;

    /**
     * @var string|null
     */
    private $vendornumber;

    /**
     * @var string|null
     */
    private $vendorname;

    /**
     * @var string|null
     */
    private $vendoraddressline1;

    /**
     * @var string|null
     */
    private $vendoraddressline2;

    /**
     * @var string|null
     */
    private $vendoraddressline3;

    /**
     * @var string|null
     */
    private $vendorzipcode;

    /**
     * @var string|null
     */
    private $vendorcity;

    /**
     * @var string|null
     */
    private $vendorstate;

    /**
     * @var string|null
     */
    private $vendorcountrycode;

    /**
     * @var string|null
     */
    private $vendorcountryname;

    /**
     * @var string|null
     */
    private $vendorcontact;

    /**
     * @var string|null
     */
    private $vendorcontactemail;

    /**
     * @var string|null
     */
    private $vendorphonenumber;

    /**
     * @var string|null
     */
    private $deliverymethod;

    /**
     * @var string|null
     */
    private $warehouse;

    /**
     * @var string|null
     */
    private $selectioncode;

    /**
     * @var string|null
     */
    private $selectioncodedescription;

    /**
     * @var int
     */
    private $purchaseorderlineid = '-1';

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
    private $unitcode;

    /**
     * @var string|null
     */
    private $salesunitcode;

    /**
     * @var string
     */
    private $salesunitfactor = '1';

    /**
     * @var string|null
     */
    private $defaultvendoritemcode;

    /**
     * @var string|null
     */
    private $defaultvendorbarcode;

    /**
     * @var string|null
     */
    private $currentvendoritemcode;

    /**
     * @var string|null
     */
    private $currentvendorbarcode;

    /**
     * @var string
     */
    private $quantityordered = '0';

    /**
     * @var string
     */
    private $quantityreceived = '0';

    /**
     * @var string
     */
    private $quantitytoreceive = '0';

    /**
     * @var \DateTime|null
     */
    private $dateexpected;

    /**
     * @var string|null
     */
    private $lineinstruction;

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
    private $itemweight = '0';

    /**
     * @var string|null
     */
    private $linedescription;

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
    private $itempurchaseprice = '0';

    /**
     * @var string|null
     */
    private $itemdefaultlocation;

    /**
     * @var string|null
     */
    private $prereceiptid;

    /**
     * @var string|null
     */
    private $prereceiptdescription;

    /**
     * @var string|null
     */
    private $prereceipttransactionid;

    /**
     * @var string|null
     */
    private $inboundlocation;

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
     * Get purchaseordersPk.
     *
     * @return int
     */
    public function getPurchaseordersPk()
    {
        return $this->purchaseordersPk;
    }

    /**
     * Set groupguid.
     *
     * @param string|null $groupguid
     *
     * @return Purchaseorders
     */
    public function setGroupguid($groupguid = null)
    {
        $this->groupguid = $groupguid;

        return $this;
    }

    /**
     * Get groupguid.
     *
     * @return string|null
     */
    public function getGroupguid()
    {
        return $this->groupguid;
    }

    /**
     * Set erpid.
     *
     * @param string|null $erpid
     *
     * @return Purchaseorders
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

    /**
     * Set purchaseorderid.
     *
     * @param int $purchaseorderid
     *
     * @return Purchaseorders
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
     * Set ordernumber.
     *
     * @param string|null $ordernumber
     *
     * @return Purchaseorders
     */
    public function setOrdernumber($ordernumber = null)
    {
        $this->ordernumber = $ordernumber;

        return $this;
    }

    /**
     * Get ordernumber.
     *
     * @return string|null
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * Set yourreference.
     *
     * @param string|null $yourreference
     *
     * @return Purchaseorders
     */
    public function setYourreference($yourreference = null)
    {
        $this->yourreference = $yourreference;

        return $this;
    }

    /**
     * Get yourreference.
     *
     * @return string|null
     */
    public function getYourreference()
    {
        return $this->yourreference;
    }

    /**
     * Set dateordered.
     *
     * @param \DateTime|null $dateordered
     *
     * @return Purchaseorders
     */
    public function setDateordered($dateordered = null)
    {
        $this->dateordered = $dateordered;

        return $this;
    }

    /**
     * Get dateordered.
     *
     * @return \DateTime|null
     */
    public function getDateordered()
    {
        return $this->dateordered;
    }

    /**
     * Set datefirstexpected.
     *
     * @param \DateTime|null $datefirstexpected
     *
     * @return Purchaseorders
     */
    public function setDatefirstexpected($datefirstexpected = null)
    {
        $this->datefirstexpected = $datefirstexpected;

        return $this;
    }

    /**
     * Get datefirstexpected.
     *
     * @return \DateTime|null
     */
    public function getDatefirstexpected()
    {
        return $this->datefirstexpected;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Purchaseorders
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
     * Set projectcode.
     *
     * @param string|null $projectcode
     *
     * @return Purchaseorders
     */
    public function setProjectcode($projectcode = null)
    {
        $this->projectcode = $projectcode;

        return $this;
    }

    /**
     * Get projectcode.
     *
     * @return string|null
     */
    public function getProjectcode()
    {
        return $this->projectcode;
    }

    /**
     * Set projectname.
     *
     * @param string|null $projectname
     *
     * @return Purchaseorders
     */
    public function setProjectname($projectname = null)
    {
        $this->projectname = $projectname;

        return $this;
    }

    /**
     * Get projectname.
     *
     * @return string|null
     */
    public function getProjectname()
    {
        return $this->projectname;
    }

    /**
     * Set businessunit.
     *
     * @param string|null $businessunit
     *
     * @return Purchaseorders
     */
    public function setBusinessunit($businessunit = null)
    {
        $this->businessunit = $businessunit;

        return $this;
    }

    /**
     * Get businessunit.
     *
     * @return string|null
     */
    public function getBusinessunit()
    {
        return $this->businessunit;
    }

    /**
     * Set vendornumber.
     *
     * @param string|null $vendornumber
     *
     * @return Purchaseorders
     */
    public function setVendornumber($vendornumber = null)
    {
        $this->vendornumber = $vendornumber;

        return $this;
    }

    /**
     * Get vendornumber.
     *
     * @return string|null
     */
    public function getVendornumber()
    {
        return $this->vendornumber;
    }

    /**
     * Set vendorname.
     *
     * @param string|null $vendorname
     *
     * @return Purchaseorders
     */
    public function setVendorname($vendorname = null)
    {
        $this->vendorname = $vendorname;

        return $this;
    }

    /**
     * Get vendorname.
     *
     * @return string|null
     */
    public function getVendorname()
    {
        return $this->vendorname;
    }

    /**
     * Set vendoraddressline1.
     *
     * @param string|null $vendoraddressline1
     *
     * @return Purchaseorders
     */
    public function setVendoraddressline1($vendoraddressline1 = null)
    {
        $this->vendoraddressline1 = $vendoraddressline1;

        return $this;
    }

    /**
     * Get vendoraddressline1.
     *
     * @return string|null
     */
    public function getVendoraddressline1()
    {
        return $this->vendoraddressline1;
    }

    /**
     * Set vendoraddressline2.
     *
     * @param string|null $vendoraddressline2
     *
     * @return Purchaseorders
     */
    public function setVendoraddressline2($vendoraddressline2 = null)
    {
        $this->vendoraddressline2 = $vendoraddressline2;

        return $this;
    }

    /**
     * Get vendoraddressline2.
     *
     * @return string|null
     */
    public function getVendoraddressline2()
    {
        return $this->vendoraddressline2;
    }

    /**
     * Set vendoraddressline3.
     *
     * @param string|null $vendoraddressline3
     *
     * @return Purchaseorders
     */
    public function setVendoraddressline3($vendoraddressline3 = null)
    {
        $this->vendoraddressline3 = $vendoraddressline3;

        return $this;
    }

    /**
     * Get vendoraddressline3.
     *
     * @return string|null
     */
    public function getVendoraddressline3()
    {
        return $this->vendoraddressline3;
    }

    /**
     * Set vendorzipcode.
     *
     * @param string|null $vendorzipcode
     *
     * @return Purchaseorders
     */
    public function setVendorzipcode($vendorzipcode = null)
    {
        $this->vendorzipcode = $vendorzipcode;

        return $this;
    }

    /**
     * Get vendorzipcode.
     *
     * @return string|null
     */
    public function getVendorzipcode()
    {
        return $this->vendorzipcode;
    }

    /**
     * Set vendorcity.
     *
     * @param string|null $vendorcity
     *
     * @return Purchaseorders
     */
    public function setVendorcity($vendorcity = null)
    {
        $this->vendorcity = $vendorcity;

        return $this;
    }

    /**
     * Get vendorcity.
     *
     * @return string|null
     */
    public function getVendorcity()
    {
        return $this->vendorcity;
    }

    /**
     * Set vendorstate.
     *
     * @param string|null $vendorstate
     *
     * @return Purchaseorders
     */
    public function setVendorstate($vendorstate = null)
    {
        $this->vendorstate = $vendorstate;

        return $this;
    }

    /**
     * Get vendorstate.
     *
     * @return string|null
     */
    public function getVendorstate()
    {
        return $this->vendorstate;
    }

    /**
     * Set vendorcountrycode.
     *
     * @param string|null $vendorcountrycode
     *
     * @return Purchaseorders
     */
    public function setVendorcountrycode($vendorcountrycode = null)
    {
        $this->vendorcountrycode = $vendorcountrycode;

        return $this;
    }

    /**
     * Get vendorcountrycode.
     *
     * @return string|null
     */
    public function getVendorcountrycode()
    {
        return $this->vendorcountrycode;
    }

    /**
     * Set vendorcountryname.
     *
     * @param string|null $vendorcountryname
     *
     * @return Purchaseorders
     */
    public function setVendorcountryname($vendorcountryname = null)
    {
        $this->vendorcountryname = $vendorcountryname;

        return $this;
    }

    /**
     * Get vendorcountryname.
     *
     * @return string|null
     */
    public function getVendorcountryname()
    {
        return $this->vendorcountryname;
    }

    /**
     * Set vendorcontact.
     *
     * @param string|null $vendorcontact
     *
     * @return Purchaseorders
     */
    public function setVendorcontact($vendorcontact = null)
    {
        $this->vendorcontact = $vendorcontact;

        return $this;
    }

    /**
     * Get vendorcontact.
     *
     * @return string|null
     */
    public function getVendorcontact()
    {
        return $this->vendorcontact;
    }

    /**
     * Set vendorcontactemail.
     *
     * @param string|null $vendorcontactemail
     *
     * @return Purchaseorders
     */
    public function setVendorcontactemail($vendorcontactemail = null)
    {
        $this->vendorcontactemail = $vendorcontactemail;

        return $this;
    }

    /**
     * Get vendorcontactemail.
     *
     * @return string|null
     */
    public function getVendorcontactemail()
    {
        return $this->vendorcontactemail;
    }

    /**
     * Set vendorphonenumber.
     *
     * @param string|null $vendorphonenumber
     *
     * @return Purchaseorders
     */
    public function setVendorphonenumber($vendorphonenumber = null)
    {
        $this->vendorphonenumber = $vendorphonenumber;

        return $this;
    }

    /**
     * Get vendorphonenumber.
     *
     * @return string|null
     */
    public function getVendorphonenumber()
    {
        return $this->vendorphonenumber;
    }

    /**
     * Set deliverymethod.
     *
     * @param string|null $deliverymethod
     *
     * @return Purchaseorders
     */
    public function setDeliverymethod($deliverymethod = null)
    {
        $this->deliverymethod = $deliverymethod;

        return $this;
    }

    /**
     * Get deliverymethod.
     *
     * @return string|null
     */
    public function getDeliverymethod()
    {
        return $this->deliverymethod;
    }

    /**
     * Set warehouse.
     *
     * @param string|null $warehouse
     *
     * @return Purchaseorders
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
     * Set selectioncode.
     *
     * @param string|null $selectioncode
     *
     * @return Purchaseorders
     */
    public function setSelectioncode($selectioncode = null)
    {
        $this->selectioncode = $selectioncode;

        return $this;
    }

    /**
     * Get selectioncode.
     *
     * @return string|null
     */
    public function getSelectioncode()
    {
        return $this->selectioncode;
    }

    /**
     * Set selectioncodedescription.
     *
     * @param string|null $selectioncodedescription
     *
     * @return Purchaseorders
     */
    public function setSelectioncodedescription($selectioncodedescription = null)
    {
        $this->selectioncodedescription = $selectioncodedescription;

        return $this;
    }

    /**
     * Get selectioncodedescription.
     *
     * @return string|null
     */
    public function getSelectioncodedescription()
    {
        return $this->selectioncodedescription;
    }

    /**
     * Set purchaseorderlineid.
     *
     * @param int $purchaseorderlineid
     *
     * @return Purchaseorders
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
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * Set unitcode.
     *
     * @param string|null $unitcode
     *
     * @return Purchaseorders
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
     * Set salesunitcode.
     *
     * @param string|null $salesunitcode
     *
     * @return Purchaseorders
     */
    public function setSalesunitcode($salesunitcode = null)
    {
        $this->salesunitcode = $salesunitcode;

        return $this;
    }

    /**
     * Get salesunitcode.
     *
     * @return string|null
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
     * @return Purchaseorders
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
     * Set defaultvendoritemcode.
     *
     * @param string|null $defaultvendoritemcode
     *
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * Set currentvendoritemcode.
     *
     * @param string|null $currentvendoritemcode
     *
     * @return Purchaseorders
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
     * Set currentvendorbarcode.
     *
     * @param string|null $currentvendorbarcode
     *
     * @return Purchaseorders
     */
    public function setCurrentvendorbarcode($currentvendorbarcode = null)
    {
        $this->currentvendorbarcode = $currentvendorbarcode;

        return $this;
    }

    /**
     * Get currentvendorbarcode.
     *
     * @return string|null
     */
    public function getCurrentvendorbarcode()
    {
        return $this->currentvendorbarcode;
    }

    /**
     * Set quantityordered.
     *
     * @param string $quantityordered
     *
     * @return Purchaseorders
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
     * Set quantityreceived.
     *
     * @param string $quantityreceived
     *
     * @return Purchaseorders
     */
    public function setQuantityreceived($quantityreceived)
    {
        $this->quantityreceived = $quantityreceived;

        return $this;
    }

    /**
     * Get quantityreceived.
     *
     * @return string
     */
    public function getQuantityreceived()
    {
        return $this->quantityreceived;
    }

    /**
     * Set quantitytoreceive.
     *
     * @param string $quantitytoreceive
     *
     * @return Purchaseorders
     */
    public function setQuantitytoreceive($quantitytoreceive)
    {
        $this->quantitytoreceive = $quantitytoreceive;

        return $this;
    }

    /**
     * Get quantitytoreceive.
     *
     * @return string
     */
    public function getQuantitytoreceive()
    {
        return $this->quantitytoreceive;
    }

    /**
     * Set dateexpected.
     *
     * @param \DateTime|null $dateexpected
     *
     * @return Purchaseorders
     */
    public function setDateexpected($dateexpected = null)
    {
        $this->dateexpected = $dateexpected;

        return $this;
    }

    /**
     * Get dateexpected.
     *
     * @return \DateTime|null
     */
    public function getDateexpected()
    {
        return $this->dateexpected;
    }

    /**
     * Set lineinstruction.
     *
     * @param string|null $lineinstruction
     *
     * @return Purchaseorders
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
     * Set isbatchnumberitem.
     *
     * @param bool $isbatchnumberitem
     *
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * Set itemweight.
     *
     * @param string $itemweight
     *
     * @return Purchaseorders
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
     * Set linedescription.
     *
     * @param string|null $linedescription
     *
     * @return Purchaseorders
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
     * Set itemlongdescription.
     *
     * @param string|null $itemlongdescription
     *
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * Set itemdefaultlocation.
     *
     * @param string|null $itemdefaultlocation
     *
     * @return Purchaseorders
     */
    public function setItemdefaultlocation($itemdefaultlocation = null)
    {
        $this->itemdefaultlocation = $itemdefaultlocation;

        return $this;
    }

    /**
     * Get itemdefaultlocation.
     *
     * @return string|null
     */
    public function getItemdefaultlocation()
    {
        return $this->itemdefaultlocation;
    }

    /**
     * Set prereceiptid.
     *
     * @param string|null $prereceiptid
     *
     * @return Purchaseorders
     */
    public function setPrereceiptid($prereceiptid = null)
    {
        $this->prereceiptid = $prereceiptid;

        return $this;
    }

    /**
     * Get prereceiptid.
     *
     * @return string|null
     */
    public function getPrereceiptid()
    {
        return $this->prereceiptid;
    }

    /**
     * Set prereceiptdescription.
     *
     * @param string|null $prereceiptdescription
     *
     * @return Purchaseorders
     */
    public function setPrereceiptdescription($prereceiptdescription = null)
    {
        $this->prereceiptdescription = $prereceiptdescription;

        return $this;
    }

    /**
     * Get prereceiptdescription.
     *
     * @return string|null
     */
    public function getPrereceiptdescription()
    {
        return $this->prereceiptdescription;
    }

    /**
     * Set prereceipttransactionid.
     *
     * @param string|null $prereceipttransactionid
     *
     * @return Purchaseorders
     */
    public function setPrereceipttransactionid($prereceipttransactionid = null)
    {
        $this->prereceipttransactionid = $prereceipttransactionid;

        return $this;
    }

    /**
     * Get prereceipttransactionid.
     *
     * @return string|null
     */
    public function getPrereceipttransactionid()
    {
        return $this->prereceipttransactionid;
    }

    /**
     * Set inboundlocation.
     *
     * @param string|null $inboundlocation
     *
     * @return Purchaseorders
     */
    public function setInboundlocation($inboundlocation = null)
    {
        $this->inboundlocation = $inboundlocation;

        return $this;
    }

    /**
     * Get inboundlocation.
     *
     * @return string|null
     */
    public function getInboundlocation()
    {
        return $this->inboundlocation;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
     * @return Purchaseorders
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
