<?php

namespace PenD\Docker\Application\Model;

/**
 * Shipmentpackageitems
 */
class Shipmentpackageitems
{
    /**
     * @var int
     */
    private $shipmemtpackageitemsPk;

    /**
     * @var string|null
     */
    private $innerreference;

    /**
     * @var string|null
     */
    private $itemidnumber;

    /**
     * @var string
     */
    private $quantity;

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
     * @var \PenD\Docker\Application\Model\Outboundorders
     */
    private $outboundorderFk;

    /**
     * @var \PenD\Docker\Application\Model\Shipmentpackages
     */
    private $shipmentpackageFk;


    /**
     * Get shipmemtpackageitemsPk.
     *
     * @return int
     */
    public function getShipmemtpackageitemsPk()
    {
        return $this->shipmemtpackageitemsPk;
    }

    /**
     * Set innerreference.
     *
     * @param string|null $innerreference
     *
     * @return Shipmentpackageitems
     */
    public function setInnerreference($innerreference = null)
    {
        $this->innerreference = $innerreference;

        return $this;
    }

    /**
     * Get innerreference.
     *
     * @return string|null
     */
    public function getInnerreference()
    {
        return $this->innerreference;
    }

    /**
     * Set itemidnumber.
     *
     * @param string|null $itemidnumber
     *
     * @return Shipmentpackageitems
     */
    public function setItemidnumber($itemidnumber = null)
    {
        $this->itemidnumber = $itemidnumber;

        return $this;
    }

    /**
     * Get itemidnumber.
     *
     * @return string|null
     */
    public function getItemidnumber()
    {
        return $this->itemidnumber;
    }

    /**
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Shipmentpackageitems
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipmentpackageitems
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
     * @return Shipmentpackageitems
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
     * @return Shipmentpackageitems
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
     * @return Shipmentpackageitems
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
     * @return Shipmentpackageitems
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
     * Set outboundorderFk.
     *
     * @param \PenD\Docker\Application\Model\Outboundorders|null $outboundorderFk
     *
     * @return Shipmentpackageitems
     */
    public function setOutboundorderFk(\PenD\Docker\Application\Model\Outboundorders $outboundorderFk = null)
    {
        $this->outboundorderFk = $outboundorderFk;

        return $this;
    }

    /**
     * Get outboundorderFk.
     *
     * @return \PenD\Docker\Application\Model\Outboundorders|null
     */
    public function getOutboundorderFk()
    {
        return $this->outboundorderFk;
    }

    /**
     * Set shipmentpackageFk.
     *
     * @param \PenD\Docker\Application\Model\Shipmentpackages|null $shipmentpackageFk
     *
     * @return Shipmentpackageitems
     */
    public function setShipmentpackageFk(\PenD\Docker\Application\Model\Shipmentpackages $shipmentpackageFk = null)
    {
        $this->shipmentpackageFk = $shipmentpackageFk;

        return $this;
    }

    /**
     * Get shipmentpackageFk.
     *
     * @return \PenD\Docker\Application\Model\Shipmentpackages|null
     */
    public function getShipmentpackageFk()
    {
        return $this->shipmentpackageFk;
    }
}
