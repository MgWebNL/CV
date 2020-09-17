<?php

namespace PenD\Docker\Application\Model;

/**
 * Shipmentdocuments
 */
class Shipmentdocuments
{
    /**
     * @var int
     */
    private $shipmentdocumentPk;

    /**
     * @var int
     */
    private $shipmentFk;

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
     * Get shipmentdocumentPk.
     *
     * @return int
     */
    public function getShipmentdocumentPk()
    {
        return $this->shipmentdocumentPk;
    }

    /**
     * Set shipmentFk.
     *
     * @param int $shipmentFk
     *
     * @return Shipmentdocuments
     */
    public function setShipmentFk($shipmentFk)
    {
        $this->shipmentFk = $shipmentFk;

        return $this;
    }

    /**
     * Get shipmentFk.
     *
     * @return int
     */
    public function getShipmentFk()
    {
        return $this->shipmentFk;
    }

    /**
     * Set documenttype.
     *
     * @param string $documenttype
     *
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
     * @return Shipmentdocuments
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
