<?php

namespace PenD\Docker\Application\Model;

/**
 * Shipmentpackagedocuments
 */
class Shipmentpackagedocuments
{
    /**
     * @var int
     */
    private $shipmentdocumentsPk;

    /**
     * @var int
     */
    private $shipmentpackagesFk;

    /**
     * @var string
     */
    private $documenttype;

    /**
     * @var string
     */
    private $documentdata;

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
     * Get shipmentdocumentsPk.
     *
     * @return int
     */
    public function getShipmentdocumentsPk()
    {
        return $this->shipmentdocumentsPk;
    }

    /**
     * Set shipmentpackagesFk.
     *
     * @param int $shipmentpackagesFk
     *
     * @return Shipmentpackagedocuments
     */
    public function setShipmentpackagesFk($shipmentpackagesFk)
    {
        $this->shipmentpackagesFk = $shipmentpackagesFk;

        return $this;
    }

    /**
     * Get shipmentpackagesFk.
     *
     * @return int
     */
    public function getShipmentpackagesFk()
    {
        return $this->shipmentpackagesFk;
    }

    /**
     * Set documenttype.
     *
     * @param string $documenttype
     *
     * @return Shipmentpackagedocuments
     */
    public function setDocumenttype($documenttype)
    {
        $this->documenttype = $documenttype;

        return $this;
    }

    /**
     * Get documenttype.
     *
     * @return string
     */
    public function getDocumenttype()
    {
        return $this->documenttype;
    }

    /**
     * Set documentdata.
     *
     * @param string $documentdata
     *
     * @return Shipmentpackagedocuments
     */
    public function setDocumentdata($documentdata)
    {
        $this->documentdata = $documentdata;

        return $this;
    }

    /**
     * Get documentdata.
     *
     * @return string
     */
    public function getDocumentdata()
    {
        return $this->documentdata;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipmentpackagedocuments
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
     * @return Shipmentpackagedocuments
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
     * @return Shipmentpackagedocuments
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
     * @return Shipmentpackagedocuments
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
     * @return Shipmentpackagedocuments
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
