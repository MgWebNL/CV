<?php

namespace PenD\Docker\Application\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Shipmentpackages
 */
class Shipmentpackages
{
    /**
     * @var int
     */
    private $shipmentpackagePk;

    /**
     * @var string|null
     */
    private $yourreference;

    /**
     * @var string|null
     */
    private $ourreference;

    /**
     * @var string|null
     */
    private $customerreference;

    /**
     * @var string|null
     */
    private $outerreference;

    /**
     * @var string|null
     */
    private $weight;

    /**
     * @var string|null
     */
    private $dimensions;

    /**
     * @var string|null
     */
    private $volume;

    /**
     * @var int|null
     */
    private $boxnumber;

    /**
     * @var \DateTime|null
     */
    private $date;

    /**
     * @var string|null
     */
    private $packagetype;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $labelduplicate;

    /**
     * @var int|null
     */
    private $cashamount;

    /**
     * @var string|null
     */
    private $cashcurrency;

    /**
     * @var int
     */
    private $collicount = '0';

    /**
     * @var string|null
     */
    private $trackingurl;

    /**
     * @var string|null
     */
    private $collipresetname;

    /**
     * @var string|null
     */
    private $collispecificationcode;

    /**
     * @var string|null
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $boxid;

    /**
     * @var int
     */
    private $stockregistration = '0';

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
     * @var \PenD\Docker\Application\Model\Shipments
     */
    private $shipmentFk;

    /**
     * @var Collection|Outboundorders[]
     */
    private $outboundorders;

    /**
     * @return Collection|Outboundorders[]
     */
    public function getOutboundorders()
    {
        return $this->outboundorders;
    }

    /**
     * @param Collection|Outboundorders[] $outboundorders
     */
    public function setOutboundorders($outboundorders): void
    {
        $this->outboundorders = $outboundorders;
    }


    /**
     * Get shipmentpackagePk.
     *
     * @return int
     */
    public function getShipmentpackagePk()
    {
        return $this->shipmentpackagePk;
    }

    /**
     * Set yourreference.
     *
     * @param string|null $yourreference
     *
     * @return Shipmentpackages
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
     * Set ourreference.
     *
     * @param string|null $ourreference
     *
     * @return Shipmentpackages
     */
    public function setOurreference($ourreference = null)
    {
        $this->ourreference = $ourreference;

        return $this;
    }

    /**
     * Get ourreference.
     *
     * @return string|null
     */
    public function getOurreference()
    {
        return $this->ourreference;
    }

    /**
     * Set customerreference.
     *
     * @param string|null $customerreference
     *
     * @return Shipmentpackages
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
     * Set outerreference.
     *
     * @param string|null $outerreference
     *
     * @return Shipmentpackages
     */
    public function setOuterreference($outerreference = null)
    {
        $this->outerreference = $outerreference;

        return $this;
    }

    /**
     * Get outerreference.
     *
     * @return string|null
     */
    public function getOuterreference()
    {
        return $this->outerreference;
    }

    /**
     * Set weight.
     *
     * @param string|null $weight
     *
     * @return Shipmentpackages
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return string|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set dimensions.
     *
     * @param string|null $dimensions
     *
     * @return Shipmentpackages
     */
    public function setDimensions($dimensions = null)
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    /**
     * Get dimensions.
     *
     * @return string|null
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * Set volume.
     *
     * @param string|null $volume
     *
     * @return Shipmentpackages
     */
    public function setVolume($volume = null)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume.
     *
     * @return string|null
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set boxnumber.
     *
     * @param int|null $boxnumber
     *
     * @return Shipmentpackages
     */
    public function setBoxnumber($boxnumber = null)
    {
        $this->boxnumber = $boxnumber;

        return $this;
    }

    /**
     * Get boxnumber.
     *
     * @return int|null
     */
    public function getBoxnumber()
    {
        return $this->boxnumber;
    }

    /**
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return Shipmentpackages
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set packagetype.
     *
     * @param string|null $packagetype
     *
     * @return Shipmentpackages
     */
    public function setPackagetype($packagetype = null)
    {
        $this->packagetype = $packagetype;

        return $this;
    }

    /**
     * Get packagetype.
     *
     * @return string|null
     */
    public function getPackagetype()
    {
        return $this->packagetype;
    }

    /**
     * Set label.
     *
     * @param string|null $label
     *
     * @return Shipmentpackages
     */
    public function setLabel($label = null)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set labelduplicate.
     *
     * @param string|null $labelduplicate
     *
     * @return Shipmentpackages
     */
    public function setLabelduplicate($labelduplicate = null)
    {
        $this->labelduplicate = $labelduplicate;

        return $this;
    }

    /**
     * Get labelduplicate.
     *
     * @return string|null
     */
    public function getLabelduplicate()
    {
        return $this->labelduplicate;
    }

    /**
     * Set cashamount.
     *
     * @param int|null $cashamount
     *
     * @return Shipmentpackages
     */
    public function setCashamount($cashamount = null)
    {
        $this->cashamount = $cashamount;

        return $this;
    }

    /**
     * Get cashamount.
     *
     * @return int|null
     */
    public function getCashamount()
    {
        return $this->cashamount;
    }

    /**
     * Set cashcurrency.
     *
     * @param string|null $cashcurrency
     *
     * @return Shipmentpackages
     */
    public function setCashcurrency($cashcurrency = null)
    {
        $this->cashcurrency = $cashcurrency;

        return $this;
    }

    /**
     * Get cashcurrency.
     *
     * @return string|null
     */
    public function getCashcurrency()
    {
        return $this->cashcurrency;
    }

    /**
     * Set collicount.
     *
     * @param int $collicount
     *
     * @return Shipmentpackages
     */
    public function setCollicount($collicount)
    {
        $this->collicount = $collicount;

        return $this;
    }

    /**
     * Get collicount.
     *
     * @return int
     */
    public function getCollicount()
    {
        return $this->collicount;
    }

    /**
     * Set trackingurl.
     *
     * @param string|null $trackingurl
     *
     * @return Shipmentpackages
     */
    public function setTrackingurl($trackingurl = null)
    {
        $this->trackingurl = $trackingurl;

        return $this;
    }

    /**
     * Get trackingurl.
     *
     * @return string|null
     */
    public function getTrackingurl()
    {
        return $this->trackingurl;
    }

    /**
     * Set collipresetname.
     *
     * @param string|null $collipresetname
     *
     * @return Shipmentpackages
     */
    public function setCollipresetname($collipresetname = null)
    {
        $this->collipresetname = $collipresetname;

        return $this;
    }

    /**
     * Get collipresetname.
     *
     * @return string|null
     */
    public function getCollipresetname()
    {
        return $this->collipresetname;
    }

    /**
     * Set collispecificationcode.
     *
     * @param string|null $collispecificationcode
     *
     * @return Shipmentpackages
     */
    public function setCollispecificationcode($collispecificationcode = null)
    {
        $this->collispecificationcode = $collispecificationcode;

        return $this;
    }

    /**
     * Get collispecificationcode.
     *
     * @return string|null
     */
    public function getCollispecificationcode()
    {
        return $this->collispecificationcode;
    }

    /**
     * Set itemcode.
     *
     * @param string|null $itemcode
     *
     * @return Shipmentpackages
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
     * Set boxid.
     *
     * @param string|null $boxid
     *
     * @return Shipmentpackages
     */
    public function setBoxid($boxid = null)
    {
        $this->boxid = $boxid;

        return $this;
    }

    /**
     * Get boxid.
     *
     * @return string|null
     */
    public function getBoxid()
    {
        return $this->boxid;
    }

    /**
     * Set stockregistration.
     *
     * @param int $stockregistration
     *
     * @return Shipmentpackages
     */
    public function setStockregistration($stockregistration)
    {
        $this->stockregistration = $stockregistration;

        return $this;
    }

    /**
     * Get stockregistration.
     *
     * @return int
     */
    public function getStockregistration()
    {
        return $this->stockregistration;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipmentpackages
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
     * @return Shipmentpackages
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
     * @return Shipmentpackages
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
     * @return Shipmentpackages
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
     * @return Shipmentpackages
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
     * Set shipmentFk.
     *
     * @param \PenD\Docker\Application\Model\Shipments|null $shipmentFk
     *
     * @return Shipmentpackages
     */
    public function setShipmentFk(\PenD\Docker\Application\Model\Shipments $shipmentFk = null)
    {
        $this->shipmentFk = $shipmentFk;

        return $this;
    }

    /**
     * Get shipmentFk.
     *
     * @return \PenD\Docker\Application\Model\Shipments|null
     */
    public function getShipmentFk()
    {
        return $this->shipmentFk;
    }
}
