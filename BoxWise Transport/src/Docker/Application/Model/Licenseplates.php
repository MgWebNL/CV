<?php

namespace PenD\Docker\Application\Model;

/**
 * Licenseplates
 */
class Licenseplates
{
    /**
     * @var int
     */
    private $licenseplatePk;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $warehousecode;

    /**
     * @var string|null
     */
    private $locationcode;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime|null
     */
    private $bestbeforedate;

    /**
     * @var string|null
     */
    private $reference;

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
     * Get licenseplatePk.
     *
     * @return int
     */
    public function getLicenseplatePk()
    {
        return $this->licenseplatePk;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Licenseplates
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Licenseplates
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
     * Set warehousecode.
     *
     * @param string|null $warehousecode
     *
     * @return Licenseplates
     */
    public function setWarehousecode($warehousecode = null)
    {
        $this->warehousecode = $warehousecode;

        return $this;
    }

    /**
     * Get warehousecode.
     *
     * @return string|null
     */
    public function getWarehousecode()
    {
        return $this->warehousecode;
    }

    /**
     * Set locationcode.
     *
     * @param string|null $locationcode
     *
     * @return Licenseplates
     */
    public function setLocationcode($locationcode = null)
    {
        $this->locationcode = $locationcode;

        return $this;
    }

    /**
     * Get locationcode.
     *
     * @return string|null
     */
    public function getLocationcode()
    {
        return $this->locationcode;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Licenseplates
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set bestbeforedate.
     *
     * @param \DateTime|null $bestbeforedate
     *
     * @return Licenseplates
     */
    public function setBestbeforedate($bestbeforedate = null)
    {
        $this->bestbeforedate = $bestbeforedate;

        return $this;
    }

    /**
     * Get bestbeforedate.
     *
     * @return \DateTime|null
     */
    public function getBestbeforedate()
    {
        return $this->bestbeforedate;
    }

    /**
     * Set reference.
     *
     * @param string|null $reference
     *
     * @return Licenseplates
     */
    public function setReference($reference = null)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Licenseplates
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
     * @return Licenseplates
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
     * @return Licenseplates
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
     * @return Licenseplates
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
     * @return Licenseplates
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
