<?php

namespace PenD\Docker\Application\Model;

/**
 * Prereceiptpurchaseorders
 */
class Prereceiptpurchaseorders
{
    /**
     * @var int
     */
    private $prereceiptpurchaseorderPk;

    /**
     * @var int
     */
    private $purchaseorderid;

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
    private $selectioncode;

    /**
     * @var string|null
     */
    private $selectioncodedescription;

    /**
     * @var \PenD\Docker\Application\Model\Prereceipts
     */
    private $prereceiptFk;


    /**
     * Get prereceiptpurchaseorderPk.
     *
     * @return int
     */
    public function getPrereceiptpurchaseorderPk()
    {
        return $this->prereceiptpurchaseorderPk;
    }

    /**
     * Set purchaseorderid.
     *
     * @param int $purchaseorderid
     *
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * Set selectioncode.
     *
     * @param string|null $selectioncode
     *
     * @return Prereceiptpurchaseorders
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
     * @return Prereceiptpurchaseorders
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
     * Set prereceiptFk.
     *
     * @param \PenD\Docker\Application\Model\Prereceipts|null $prereceiptFk
     *
     * @return Prereceiptpurchaseorders
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
