<?php

namespace PenD\Docker\Application\Model;

/**
 * Shipperservicelinks
 */
class Shipperservicelinks
{
    /**
     * @var int
     */
    private $shipperservicelinkPk;

    /**
     * @var string
     */
    private $erpdeliverymethodcode;

    /**
     * @var string
     */
    private $erpdeliverymethoddescription;

    /**
     * @var string
     */
    private $shipperid;

    /**
     * @var string
     */
    private $servicelevel;

    /**
     * @var bool
     */
    private $allowdifferentchoice;

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
     * Get shipperservicelinkPk.
     *
     * @return int
     */
    public function getShipperservicelinkPk()
    {
        return $this->shipperservicelinkPk;
    }

    /**
     * Set erpdeliverymethodcode.
     *
     * @param string $erpdeliverymethodcode
     *
     * @return Shipperservicelinks
     */
    public function setErpdeliverymethodcode($erpdeliverymethodcode)
    {
        $this->erpdeliverymethodcode = $erpdeliverymethodcode;

        return $this;
    }

    /**
     * Get erpdeliverymethodcode.
     *
     * @return string
     */
    public function getErpdeliverymethodcode()
    {
        return $this->erpdeliverymethodcode;
    }

    /**
     * Set erpdeliverymethoddescription.
     *
     * @param string $erpdeliverymethoddescription
     *
     * @return Shipperservicelinks
     */
    public function setErpdeliverymethoddescription($erpdeliverymethoddescription)
    {
        $this->erpdeliverymethoddescription = $erpdeliverymethoddescription;

        return $this;
    }

    /**
     * Get erpdeliverymethoddescription.
     *
     * @return string
     */
    public function getErpdeliverymethoddescription()
    {
        return $this->erpdeliverymethoddescription;
    }

    /**
     * Set shipperid.
     *
     * @param string $shipperid
     *
     * @return Shipperservicelinks
     */
    public function setShipperid($shipperid)
    {
        $this->shipperid = $shipperid;

        return $this;
    }

    /**
     * Get shipperid.
     *
     * @return string
     */
    public function getShipperid()
    {
        return $this->shipperid;
    }

    /**
     * Set servicelevel.
     *
     * @param string $servicelevel
     *
     * @return Shipperservicelinks
     */
    public function setServicelevel($servicelevel)
    {
        $this->servicelevel = $servicelevel;

        return $this;
    }

    /**
     * Get servicelevel.
     *
     * @return string
     */
    public function getServicelevel()
    {
        return $this->servicelevel;
    }

    /**
     * Set allowdifferentchoice.
     *
     * @param bool $allowdifferentchoice
     *
     * @return Shipperservicelinks
     */
    public function setAllowdifferentchoice($allowdifferentchoice)
    {
        $this->allowdifferentchoice = $allowdifferentchoice;

        return $this;
    }

    /**
     * Get allowdifferentchoice.
     *
     * @return bool
     */
    public function getAllowdifferentchoice()
    {
        return $this->allowdifferentchoice;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipperservicelinks
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
     * @return Shipperservicelinks
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
     * @return Shipperservicelinks
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
     * @return Shipperservicelinks
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
     * @return Shipperservicelinks
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
