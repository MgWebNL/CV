<?php

namespace PenD\Docker\Application\Model;

/**
 * Rmaorders
 */
class Rmaorders
{
    /**
     * @var int
     */
    private $rmaordersPk;

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
    private $rmaorderid = '-1';

    /**
     * @var string|null
     */
    private $ordernumber;

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
    private $customernumber;

    /**
     * @var string|null
     */
    private $customername;

    /**
     * @var string|null
     */
    private $customeraddressline1;

    /**
     * @var string|null
     */
    private $customeraddressline2;

    /**
     * @var string|null
     */
    private $customeraddressline3;

    /**
     * @var string|null
     */
    private $customerzipcode;

    /**
     * @var string|null
     */
    private $customercity;

    /**
     * @var string|null
     */
    private $customerstate;

    /**
     * @var string|null
     */
    private $customercountrycode;

    /**
     * @var string|null
     */
    private $customercountryname;

    /**
     * @var string|null
     */
    private $customercontact;

    /**
     * @var string|null
     */
    private $customercontactemail;

    /**
     * @var string|null
     */
    private $customerphonenumber;

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
    private $rmaorderlineid = '-1';

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
    private $itemdefaultlocation;

    /**
     * @var string|null
     */
    private $linecurrencycode;

    /**
     * @var string
     */
    private $itemrmaprice = '0';

    /**
     * @var string|null
     */
    private $reasoncode;

    /**
     * @var string|null
     */
    private $reasondescription;

    /**
     * @var int|null
     */
    private $salesorderid;

    /**
     * @var string|null
     */
    private $salesordernumber;

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
     * Get rmaordersPk.
     *
     * @return int
     */
    public function getRmaordersPk()
    {
        return $this->rmaordersPk;
    }

    /**
     * Set groupguid.
     *
     * @param string|null $groupguid
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * Set rmaorderid.
     *
     * @param int $rmaorderid
     *
     * @return Rmaorders
     */
    public function setRmaorderid($rmaorderid)
    {
        $this->rmaorderid = $rmaorderid;

        return $this;
    }

    /**
     * Get rmaorderid.
     *
     * @return int
     */
    public function getRmaorderid()
    {
        return $this->rmaorderid;
    }

    /**
     * Set ordernumber.
     *
     * @param string|null $ordernumber
     *
     * @return Rmaorders
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
     * Set dateordered.
     *
     * @param \DateTime|null $dateordered
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * Set customernumber.
     *
     * @param string|null $customernumber
     *
     * @return Rmaorders
     */
    public function setCustomernumber($customernumber = null)
    {
        $this->customernumber = $customernumber;

        return $this;
    }

    /**
     * Get customernumber.
     *
     * @return string|null
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
     * @return Rmaorders
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
     * Set customeraddressline1.
     *
     * @param string|null $customeraddressline1
     *
     * @return Rmaorders
     */
    public function setCustomeraddressline1($customeraddressline1 = null)
    {
        $this->customeraddressline1 = $customeraddressline1;

        return $this;
    }

    /**
     * Get customeraddressline1.
     *
     * @return string|null
     */
    public function getCustomeraddressline1()
    {
        return $this->customeraddressline1;
    }

    /**
     * Set customeraddressline2.
     *
     * @param string|null $customeraddressline2
     *
     * @return Rmaorders
     */
    public function setCustomeraddressline2($customeraddressline2 = null)
    {
        $this->customeraddressline2 = $customeraddressline2;

        return $this;
    }

    /**
     * Get customeraddressline2.
     *
     * @return string|null
     */
    public function getCustomeraddressline2()
    {
        return $this->customeraddressline2;
    }

    /**
     * Set customeraddressline3.
     *
     * @param string|null $customeraddressline3
     *
     * @return Rmaorders
     */
    public function setCustomeraddressline3($customeraddressline3 = null)
    {
        $this->customeraddressline3 = $customeraddressline3;

        return $this;
    }

    /**
     * Get customeraddressline3.
     *
     * @return string|null
     */
    public function getCustomeraddressline3()
    {
        return $this->customeraddressline3;
    }

    /**
     * Set customerzipcode.
     *
     * @param string|null $customerzipcode
     *
     * @return Rmaorders
     */
    public function setCustomerzipcode($customerzipcode = null)
    {
        $this->customerzipcode = $customerzipcode;

        return $this;
    }

    /**
     * Get customerzipcode.
     *
     * @return string|null
     */
    public function getCustomerzipcode()
    {
        return $this->customerzipcode;
    }

    /**
     * Set customercity.
     *
     * @param string|null $customercity
     *
     * @return Rmaorders
     */
    public function setCustomercity($customercity = null)
    {
        $this->customercity = $customercity;

        return $this;
    }

    /**
     * Get customercity.
     *
     * @return string|null
     */
    public function getCustomercity()
    {
        return $this->customercity;
    }

    /**
     * Set customerstate.
     *
     * @param string|null $customerstate
     *
     * @return Rmaorders
     */
    public function setCustomerstate($customerstate = null)
    {
        $this->customerstate = $customerstate;

        return $this;
    }

    /**
     * Get customerstate.
     *
     * @return string|null
     */
    public function getCustomerstate()
    {
        return $this->customerstate;
    }

    /**
     * Set customercountrycode.
     *
     * @param string|null $customercountrycode
     *
     * @return Rmaorders
     */
    public function setCustomercountrycode($customercountrycode = null)
    {
        $this->customercountrycode = $customercountrycode;

        return $this;
    }

    /**
     * Get customercountrycode.
     *
     * @return string|null
     */
    public function getCustomercountrycode()
    {
        return $this->customercountrycode;
    }

    /**
     * Set customercountryname.
     *
     * @param string|null $customercountryname
     *
     * @return Rmaorders
     */
    public function setCustomercountryname($customercountryname = null)
    {
        $this->customercountryname = $customercountryname;

        return $this;
    }

    /**
     * Get customercountryname.
     *
     * @return string|null
     */
    public function getCustomercountryname()
    {
        return $this->customercountryname;
    }

    /**
     * Set customercontact.
     *
     * @param string|null $customercontact
     *
     * @return Rmaorders
     */
    public function setCustomercontact($customercontact = null)
    {
        $this->customercontact = $customercontact;

        return $this;
    }

    /**
     * Get customercontact.
     *
     * @return string|null
     */
    public function getCustomercontact()
    {
        return $this->customercontact;
    }

    /**
     * Set customercontactemail.
     *
     * @param string|null $customercontactemail
     *
     * @return Rmaorders
     */
    public function setCustomercontactemail($customercontactemail = null)
    {
        $this->customercontactemail = $customercontactemail;

        return $this;
    }

    /**
     * Get customercontactemail.
     *
     * @return string|null
     */
    public function getCustomercontactemail()
    {
        return $this->customercontactemail;
    }

    /**
     * Set customerphonenumber.
     *
     * @param string|null $customerphonenumber
     *
     * @return Rmaorders
     */
    public function setCustomerphonenumber($customerphonenumber = null)
    {
        $this->customerphonenumber = $customerphonenumber;

        return $this;
    }

    /**
     * Get customerphonenumber.
     *
     * @return string|null
     */
    public function getCustomerphonenumber()
    {
        return $this->customerphonenumber;
    }

    /**
     * Set deliverymethod.
     *
     * @param string|null $deliverymethod
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * Set rmaorderlineid.
     *
     * @param int $rmaorderlineid
     *
     * @return Rmaorders
     */
    public function setRmaorderlineid($rmaorderlineid)
    {
        $this->rmaorderlineid = $rmaorderlineid;

        return $this;
    }

    /**
     * Get rmaorderlineid.
     *
     * @return int
     */
    public function getRmaorderlineid()
    {
        return $this->rmaorderlineid;
    }

    /**
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * Set defaultvendoritemcode.
     *
     * @param string|null $defaultvendoritemcode
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * Set itemdefaultlocation.
     *
     * @param string|null $itemdefaultlocation
     *
     * @return Rmaorders
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
     * Set linecurrencycode.
     *
     * @param string|null $linecurrencycode
     *
     * @return Rmaorders
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
     * Set itemrmaprice.
     *
     * @param string $itemrmaprice
     *
     * @return Rmaorders
     */
    public function setItemrmaprice($itemrmaprice)
    {
        $this->itemrmaprice = $itemrmaprice;

        return $this;
    }

    /**
     * Get itemrmaprice.
     *
     * @return string
     */
    public function getItemrmaprice()
    {
        return $this->itemrmaprice;
    }

    /**
     * Set reasoncode.
     *
     * @param string|null $reasoncode
     *
     * @return Rmaorders
     */
    public function setReasoncode($reasoncode = null)
    {
        $this->reasoncode = $reasoncode;

        return $this;
    }

    /**
     * Get reasoncode.
     *
     * @return string|null
     */
    public function getReasoncode()
    {
        return $this->reasoncode;
    }

    /**
     * Set reasondescription.
     *
     * @param string|null $reasondescription
     *
     * @return Rmaorders
     */
    public function setReasondescription($reasondescription = null)
    {
        $this->reasondescription = $reasondescription;

        return $this;
    }

    /**
     * Get reasondescription.
     *
     * @return string|null
     */
    public function getReasondescription()
    {
        return $this->reasondescription;
    }

    /**
     * Set salesorderid.
     *
     * @param int|null $salesorderid
     *
     * @return Rmaorders
     */
    public function setSalesorderid($salesorderid = null)
    {
        $this->salesorderid = $salesorderid;

        return $this;
    }

    /**
     * Get salesorderid.
     *
     * @return int|null
     */
    public function getSalesorderid()
    {
        return $this->salesorderid;
    }

    /**
     * Set salesordernumber.
     *
     * @param string|null $salesordernumber
     *
     * @return Rmaorders
     */
    public function setSalesordernumber($salesordernumber = null)
    {
        $this->salesordernumber = $salesordernumber;

        return $this;
    }

    /**
     * Get salesordernumber.
     *
     * @return string|null
     */
    public function getSalesordernumber()
    {
        return $this->salesordernumber;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
     * @return Rmaorders
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
