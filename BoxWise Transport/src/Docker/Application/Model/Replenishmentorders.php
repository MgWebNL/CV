<?php

namespace PenD\Docker\Application\Model;

/**
 * Replenishmentorders
 */
class Replenishmentorders
{
    /**
     * @var int
     */
    private $replenishmentordersPk;

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
    private $deliverymethod;

    /**
     * @var string|null
     */
    private $warehouse;

    /**
     * @var string|null
     */
    private $warehouseto;

    /**
     * @var string|null
     */
    private $locationto;

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
     * @var bool
     */
    private $approved = '0';

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
    private $number;


    /**
     * Get replenishmentordersPk.
     *
     * @return int
     */
    public function getReplenishmentordersPk()
    {
        return $this->replenishmentordersPk;
    }

    /**
     * Set dateordered.
     *
     * @param \DateTime|null $dateordered
     *
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * Set customerreference.
     *
     * @param string|null $customerreference
     *
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * Set warehouseto.
     *
     * @param string|null $warehouseto
     *
     * @return Replenishmentorders
     */
    public function setWarehouseto($warehouseto = null)
    {
        $this->warehouseto = $warehouseto;

        return $this;
    }

    /**
     * Get warehouseto.
     *
     * @return string|null
     */
    public function getWarehouseto()
    {
        return $this->warehouseto;
    }

    /**
     * Set locationto.
     *
     * @param string|null $locationto
     *
     * @return Replenishmentorders
     */
    public function setLocationto($locationto = null)
    {
        $this->locationto = $locationto;

        return $this;
    }

    /**
     * Get locationto.
     *
     * @return string|null
     */
    public function getLocationto()
    {
        return $this->locationto;
    }

    /**
     * Set selectioncode.
     *
     * @param string|null $selectioncode
     *
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * Set approved.
     *
     * @param bool $approved
     *
     * @return Replenishmentorders
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved.
     *
     * @return bool
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * @return Replenishmentorders
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
     * Set number.
     *
     * @param string|null $number
     *
     * @return Replenishmentorders
     */
    public function setNumber($number = null)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }
}
