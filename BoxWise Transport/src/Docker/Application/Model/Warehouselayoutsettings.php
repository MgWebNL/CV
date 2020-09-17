<?php

namespace PenD\Docker\Application\Model;

/**
 * Warehouselayoutsettings
 */
class Warehouselayoutsettings
{
    /**
     * @var int
     */
    private $warehouselayoutsettingsPk;

    /**
     * @var string
     */
    private $warehousecode;

    /**
     * @var string
     */
    private $regularexpression;

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
     * Get warehouselayoutsettingsPk.
     *
     * @return int
     */
    public function getWarehouselayoutsettingsPk()
    {
        return $this->warehouselayoutsettingsPk;
    }

    /**
     * Set warehousecode.
     *
     * @param string $warehousecode
     *
     * @return Warehouselayoutsettings
     */
    public function setWarehousecode($warehousecode)
    {
        $this->warehousecode = $warehousecode;

        return $this;
    }

    /**
     * Get warehousecode.
     *
     * @return string
     */
    public function getWarehousecode()
    {
        return $this->warehousecode;
    }

    /**
     * Set regularexpression.
     *
     * @param string $regularexpression
     *
     * @return Warehouselayoutsettings
     */
    public function setRegularexpression($regularexpression)
    {
        $this->regularexpression = $regularexpression;

        return $this;
    }

    /**
     * Get regularexpression.
     *
     * @return string
     */
    public function getRegularexpression()
    {
        return $this->regularexpression;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Warehouselayoutsettings
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
     * @return Warehouselayoutsettings
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
     * @return Warehouselayoutsettings
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
     * @return Warehouselayoutsettings
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
     * @return Warehouselayoutsettings
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
