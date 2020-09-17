<?php

namespace PenD\Docker\Application\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Outboundorders
 */
class Outboundorders
{
    /**
     * @var int
     */
    private $outboundordersPk;

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
    private $outboundorderid = '-1';

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
    private $dateofdelivery;

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
    private $salesrepresentative;

    /**
     * @var string|null
     */
    private $customerreference;

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
    private $customerinvoicenumber;

    /**
     * @var string|null
     */
    private $customerinvoicename;

    /**
     * @var string|null
     */
    private $customerinvoiceaddressline1;

    /**
     * @var string|null
     */
    private $customerinvoiceaddressline2;

    /**
     * @var string|null
     */
    private $customerinvoiceaddressline3;

    /**
     * @var string|null
     */
    private $customerinvoicezipcode;

    /**
     * @var string|null
     */
    private $customerinvoicecity;

    /**
     * @var string|null
     */
    private $customerinvoicestate;

    /**
     * @var string|null
     */
    private $customerinvoicecountrycode;

    /**
     * @var string|null
     */
    private $customerinvoicecountryname;

    /**
     * @var string|null
     */
    private $customerinvoicecontactemail;

    /**
     * @var string|null
     */
    private $customerinvoicecontact;

    /**
     * @var string|null
     */
    private $customerinvoicephonenumber;

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
    private $warehouselocation;

    /**
     * @var string|null
     */
    private $selectioncode;

    /**
     * @var string|null
     */
    private $selectioncodedescription;

    /**
     * @var string|null
     */
    private $routingcode;

    /**
     * @var int
     */
    private $outboundorderlineid = '-1';

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
    private $customeritemcode;

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
     * @var \DateTime|null
     */
    private $linerequesteddate;

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
    private $itemdimensions;

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
    private $isfractionallowed = '0';

    /**
     * @var string|null
     */
    private $itemunitcode;

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
     * @var Collection|Shipmentpackages[]
     */
    private $shipmentpackages;

    /**
     * @return Collection|Shipmentpackages[]
     */
    public function getShipmentpackages()
    {
        return $this->shipmentpackages;
    }

    /**
     * @param Collection|Shipmentpackages[] $shipmentpackages
     */
    public function setShipmentpackages($shipmentpackages): void
    {
        $this->shipmentpackages = $shipmentpackages;
    }

    /**
     * Get outboundordersPk.
     *
     * @return int
     */
    public function getOutboundordersPk()
    {
        return $this->outboundordersPk;
    }

    /**
     * Set groupguid.
     *
     * @param string|null $groupguid
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set outboundorderid.
     *
     * @param int $outboundorderid
     *
     * @return Outboundorders
     */
    public function setOutboundorderid($outboundorderid)
    {
        $this->outboundorderid = $outboundorderid;

        return $this;
    }

    /**
     * Get outboundorderid.
     *
     * @return int
     */
    public function getOutboundorderid()
    {
        return $this->outboundorderid;
    }

    /**
     * Set ordernumber.
     *
     * @param string|null $ordernumber
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set dateofdelivery.
     *
     * @param \DateTime|null $dateofdelivery
     *
     * @return Outboundorders
     */
    public function setDateofdelivery($dateofdelivery = null)
    {
        $this->dateofdelivery = $dateofdelivery;

        return $this;
    }

    /**
     * Get dateofdelivery.
     *
     * @return \DateTime|null
     */
    public function getDateofdelivery()
    {
        return $this->dateofdelivery;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set salesrepresentative.
     *
     * @param string|null $salesrepresentative
     *
     * @return Outboundorders
     */
    public function setSalesrepresentative($salesrepresentative = null)
    {
        $this->salesrepresentative = $salesrepresentative;

        return $this;
    }

    /**
     * Get salesrepresentative.
     *
     * @return string|null
     */
    public function getSalesrepresentative()
    {
        return $this->salesrepresentative;
    }

    /**
     * Set customerreference.
     *
     * @param string|null $customerreference
     *
     * @return Outboundorders
     */
    public function setCustomerreference($customerreference = null)
    {
        $this->customerreference = $customerreference;

        return $this;
    }

    /**
     * Get customerreference.
     *
     * @return string|null
     */
    public function getCustomerreference()
    {
        return $this->customerreference;
    }

    /**
     * Set customernumber.
     *
     * @param string|null $customernumber
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set customerinvoicenumber.
     *
     * @param string|null $customerinvoicenumber
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicenumber($customerinvoicenumber = null)
    {
        $this->customerinvoicenumber = $customerinvoicenumber;

        return $this;
    }

    /**
     * Get customerinvoicenumber.
     *
     * @return string|null
     */
    public function getCustomerinvoicenumber()
    {
        return $this->customerinvoicenumber;
    }

    /**
     * Set customerinvoicename.
     *
     * @param string|null $customerinvoicename
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicename($customerinvoicename = null)
    {
        $this->customerinvoicename = $customerinvoicename;

        return $this;
    }

    /**
     * Get customerinvoicename.
     *
     * @return string|null
     */
    public function getCustomerinvoicename()
    {
        return $this->customerinvoicename;
    }

    /**
     * Set customerinvoiceaddressline1.
     *
     * @param string|null $customerinvoiceaddressline1
     *
     * @return Outboundorders
     */
    public function setCustomerinvoiceaddressline1($customerinvoiceaddressline1 = null)
    {
        $this->customerinvoiceaddressline1 = $customerinvoiceaddressline1;

        return $this;
    }

    /**
     * Get customerinvoiceaddressline1.
     *
     * @return string|null
     */
    public function getCustomerinvoiceaddressline1()
    {
        return $this->customerinvoiceaddressline1;
    }

    /**
     * Set customerinvoiceaddressline2.
     *
     * @param string|null $customerinvoiceaddressline2
     *
     * @return Outboundorders
     */
    public function setCustomerinvoiceaddressline2($customerinvoiceaddressline2 = null)
    {
        $this->customerinvoiceaddressline2 = $customerinvoiceaddressline2;

        return $this;
    }

    /**
     * Get customerinvoiceaddressline2.
     *
     * @return string|null
     */
    public function getCustomerinvoiceaddressline2()
    {
        return $this->customerinvoiceaddressline2;
    }

    /**
     * Set customerinvoiceaddressline3.
     *
     * @param string|null $customerinvoiceaddressline3
     *
     * @return Outboundorders
     */
    public function setCustomerinvoiceaddressline3($customerinvoiceaddressline3 = null)
    {
        $this->customerinvoiceaddressline3 = $customerinvoiceaddressline3;

        return $this;
    }

    /**
     * Get customerinvoiceaddressline3.
     *
     * @return string|null
     */
    public function getCustomerinvoiceaddressline3()
    {
        return $this->customerinvoiceaddressline3;
    }

    /**
     * Set customerinvoicezipcode.
     *
     * @param string|null $customerinvoicezipcode
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicezipcode($customerinvoicezipcode = null)
    {
        $this->customerinvoicezipcode = $customerinvoicezipcode;

        return $this;
    }

    /**
     * Get customerinvoicezipcode.
     *
     * @return string|null
     */
    public function getCustomerinvoicezipcode()
    {
        return $this->customerinvoicezipcode;
    }

    /**
     * Set customerinvoicecity.
     *
     * @param string|null $customerinvoicecity
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicecity($customerinvoicecity = null)
    {
        $this->customerinvoicecity = $customerinvoicecity;

        return $this;
    }

    /**
     * Get customerinvoicecity.
     *
     * @return string|null
     */
    public function getCustomerinvoicecity()
    {
        return $this->customerinvoicecity;
    }

    /**
     * Set customerinvoicestate.
     *
     * @param string|null $customerinvoicestate
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicestate($customerinvoicestate = null)
    {
        $this->customerinvoicestate = $customerinvoicestate;

        return $this;
    }

    /**
     * Get customerinvoicestate.
     *
     * @return string|null
     */
    public function getCustomerinvoicestate()
    {
        return $this->customerinvoicestate;
    }

    /**
     * Set customerinvoicecountrycode.
     *
     * @param string|null $customerinvoicecountrycode
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicecountrycode($customerinvoicecountrycode = null)
    {
        $this->customerinvoicecountrycode = $customerinvoicecountrycode;

        return $this;
    }

    /**
     * Get customerinvoicecountrycode.
     *
     * @return string|null
     */
    public function getCustomerinvoicecountrycode()
    {
        return $this->customerinvoicecountrycode;
    }

    /**
     * Set customerinvoicecountryname.
     *
     * @param string|null $customerinvoicecountryname
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicecountryname($customerinvoicecountryname = null)
    {
        $this->customerinvoicecountryname = $customerinvoicecountryname;

        return $this;
    }

    /**
     * Get customerinvoicecountryname.
     *
     * @return string|null
     */
    public function getCustomerinvoicecountryname()
    {
        return $this->customerinvoicecountryname;
    }

    /**
     * Set customerinvoicecontactemail.
     *
     * @param string|null $customerinvoicecontactemail
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicecontactemail($customerinvoicecontactemail = null)
    {
        $this->customerinvoicecontactemail = $customerinvoicecontactemail;

        return $this;
    }

    /**
     * Get customerinvoicecontactemail.
     *
     * @return string|null
     */
    public function getCustomerinvoicecontactemail()
    {
        return $this->customerinvoicecontactemail;
    }

    /**
     * Set customerinvoicecontact.
     *
     * @param string|null $customerinvoicecontact
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicecontact($customerinvoicecontact = null)
    {
        $this->customerinvoicecontact = $customerinvoicecontact;

        return $this;
    }

    /**
     * Get customerinvoicecontact.
     *
     * @return string|null
     */
    public function getCustomerinvoicecontact()
    {
        return $this->customerinvoicecontact;
    }

    /**
     * Set customerinvoicephonenumber.
     *
     * @param string|null $customerinvoicephonenumber
     *
     * @return Outboundorders
     */
    public function setCustomerinvoicephonenumber($customerinvoicephonenumber = null)
    {
        $this->customerinvoicephonenumber = $customerinvoicephonenumber;

        return $this;
    }

    /**
     * Get customerinvoicephonenumber.
     *
     * @return string|null
     */
    public function getCustomerinvoicephonenumber()
    {
        return $this->customerinvoicephonenumber;
    }

    /**
     * Set deliverymethod.
     *
     * @param string|null $deliverymethod
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set warehouselocation.
     *
     * @param string|null $warehouselocation
     *
     * @return Outboundorders
     */
    public function setWarehouselocation($warehouselocation = null)
    {
        $this->warehouselocation = $warehouselocation;

        return $this;
    }

    /**
     * Get warehouselocation.
     *
     * @return string|null
     */
    public function getWarehouselocation()
    {
        return $this->warehouselocation;
    }

    /**
     * Set selectioncode.
     *
     * @param string|null $selectioncode
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set routingcode.
     *
     * @param string|null $routingcode
     *
     * @return Outboundorders
     */
    public function setRoutingcode($routingcode = null)
    {
        $this->routingcode = $routingcode;

        return $this;
    }

    /**
     * Get routingcode.
     *
     * @return string|null
     */
    public function getRoutingcode()
    {
        return $this->routingcode;
    }

    /**
     * Set outboundorderlineid.
     *
     * @param int $outboundorderlineid
     *
     * @return Outboundorders
     */
    public function setOutboundorderlineid($outboundorderlineid)
    {
        $this->outboundorderlineid = $outboundorderlineid;

        return $this;
    }

    /**
     * Get outboundorderlineid.
     *
     * @return int
     */
    public function getOutboundorderlineid()
    {
        return $this->outboundorderlineid;
    }

    /**
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set customeritemcode.
     *
     * @param string|null $customeritemcode
     *
     * @return Outboundorders
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
     * Set defaultvendoritemcode.
     *
     * @param string|null $defaultvendoritemcode
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set linerequesteddate.
     *
     * @param \DateTime|null $linerequesteddate
     *
     * @return Outboundorders
     */
    public function setLinerequesteddate($linerequesteddate = null)
    {
        $this->linerequesteddate = $linerequesteddate;

        return $this;
    }

    /**
     * Get linerequesteddate.
     *
     * @return \DateTime|null
     */
    public function getLinerequesteddate()
    {
        return $this->linerequesteddate;
    }

    /**
     * Set lineinstruction.
     *
     * @param string|null $lineinstruction
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set itemdimensions.
     *
     * @param string|null $itemdimensions
     *
     * @return Outboundorders
     */
    public function setItemdimensions($itemdimensions = null)
    {
        $this->itemdimensions = $itemdimensions;

        return $this;
    }

    /**
     * Get itemdimensions.
     *
     * @return string|null
     */
    public function getItemdimensions()
    {
        return $this->itemdimensions;
    }

    /**
     * Set itemlongdescription.
     *
     * @param string|null $itemlongdescription
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * Set itemunitcode.
     *
     * @param string|null $itemunitcode
     *
     * @return Outboundorders
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
     * @return Outboundorders
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
