<?php

namespace PenD\Docker\Application\Model;

/**
 * Shipmentpackingslipdetails
 */
class Shipmentpackingslipdetails
{
    /**
     * @var int
     */
    private $shipmentpackingslipdetailsPk;

    /**
     * @var int
     */
    private $shipmentpackageitemsFk;

    /**
     * @var string|null
     */
    private $hscode;

    /**
     * @var string|null
     */
    private $hscodedescription;

    /**
     * @var string|null
     */
    private $countryoforigin;

    /**
     * @var string|null
     */
    private $reasonofexport;

    /**
     * @var string|null
     */
    private $quality;

    /**
     * @var string|null
     */
    private $composition;

    /**
     * @var string|null
     */
    private $assemblyinstructions;

    /**
     * @var string
     */
    private $grossweight = '0';

    /**
     * @var string|null
     */
    private $weightunitofmeasurement;

    /**
     * @var string
     */
    private $quantitycubicmeters = '0';

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
     * Get shipmentpackingslipdetailsPk.
     *
     * @return int
     */
    public function getShipmentpackingslipdetailsPk()
    {
        return $this->shipmentpackingslipdetailsPk;
    }

    /**
     * Set shipmentpackageitemsFk.
     *
     * @param int $shipmentpackageitemsFk
     *
     * @return Shipmentpackingslipdetails
     */
    public function setShipmentpackageitemsFk($shipmentpackageitemsFk)
    {
        $this->shipmentpackageitemsFk = $shipmentpackageitemsFk;

        return $this;
    }

    /**
     * Get shipmentpackageitemsFk.
     *
     * @return int
     */
    public function getShipmentpackageitemsFk()
    {
        return $this->shipmentpackageitemsFk;
    }

    /**
     * Set hscode.
     *
     * @param string|null $hscode
     *
     * @return Shipmentpackingslipdetails
     */
    public function setHscode($hscode = null)
    {
        $this->hscode = $hscode;

        return $this;
    }

    /**
     * Get hscode.
     *
     * @return string|null
     */
    public function getHscode()
    {
        return $this->hscode;
    }

    /**
     * Set hscodedescription.
     *
     * @param string|null $hscodedescription
     *
     * @return Shipmentpackingslipdetails
     */
    public function setHscodedescription($hscodedescription = null)
    {
        $this->hscodedescription = $hscodedescription;

        return $this;
    }

    /**
     * Get hscodedescription.
     *
     * @return string|null
     */
    public function getHscodedescription()
    {
        return $this->hscodedescription;
    }

    /**
     * Set countryoforigin.
     *
     * @param string|null $countryoforigin
     *
     * @return Shipmentpackingslipdetails
     */
    public function setCountryoforigin($countryoforigin = null)
    {
        $this->countryoforigin = $countryoforigin;

        return $this;
    }

    /**
     * Get countryoforigin.
     *
     * @return string|null
     */
    public function getCountryoforigin()
    {
        return $this->countryoforigin;
    }

    /**
     * Set reasonofexport.
     *
     * @param string|null $reasonofexport
     *
     * @return Shipmentpackingslipdetails
     */
    public function setReasonofexport($reasonofexport = null)
    {
        $this->reasonofexport = $reasonofexport;

        return $this;
    }

    /**
     * Get reasonofexport.
     *
     * @return string|null
     */
    public function getReasonofexport()
    {
        return $this->reasonofexport;
    }

    /**
     * Set quality.
     *
     * @param string|null $quality
     *
     * @return Shipmentpackingslipdetails
     */
    public function setQuality($quality = null)
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Get quality.
     *
     * @return string|null
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set composition.
     *
     * @param string|null $composition
     *
     * @return Shipmentpackingslipdetails
     */
    public function setComposition($composition = null)
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * Get composition.
     *
     * @return string|null
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Set assemblyinstructions.
     *
     * @param string|null $assemblyinstructions
     *
     * @return Shipmentpackingslipdetails
     */
    public function setAssemblyinstructions($assemblyinstructions = null)
    {
        $this->assemblyinstructions = $assemblyinstructions;

        return $this;
    }

    /**
     * Get assemblyinstructions.
     *
     * @return string|null
     */
    public function getAssemblyinstructions()
    {
        return $this->assemblyinstructions;
    }

    /**
     * Set grossweight.
     *
     * @param string $grossweight
     *
     * @return Shipmentpackingslipdetails
     */
    public function setGrossweight($grossweight)
    {
        $this->grossweight = $grossweight;

        return $this;
    }

    /**
     * Get grossweight.
     *
     * @return string
     */
    public function getGrossweight()
    {
        return $this->grossweight;
    }

    /**
     * Set weightunitofmeasurement.
     *
     * @param string|null $weightunitofmeasurement
     *
     * @return Shipmentpackingslipdetails
     */
    public function setWeightunitofmeasurement($weightunitofmeasurement = null)
    {
        $this->weightunitofmeasurement = $weightunitofmeasurement;

        return $this;
    }

    /**
     * Get weightunitofmeasurement.
     *
     * @return string|null
     */
    public function getWeightunitofmeasurement()
    {
        return $this->weightunitofmeasurement;
    }

    /**
     * Set quantitycubicmeters.
     *
     * @param string $quantitycubicmeters
     *
     * @return Shipmentpackingslipdetails
     */
    public function setQuantitycubicmeters($quantitycubicmeters)
    {
        $this->quantitycubicmeters = $quantitycubicmeters;

        return $this;
    }

    /**
     * Get quantitycubicmeters.
     *
     * @return string
     */
    public function getQuantitycubicmeters()
    {
        return $this->quantitycubicmeters;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipmentpackingslipdetails
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
     * @return Shipmentpackingslipdetails
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
     * @return Shipmentpackingslipdetails
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
     * @return Shipmentpackingslipdetails
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
     * @return Shipmentpackingslipdetails
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
