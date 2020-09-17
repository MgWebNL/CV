<?php

namespace PenD\Docker\Application\Model;

/**
 * Warehousetransfers
 */
class Warehousetransfers
{
    /**
     * @var int
     */
    private $warehousetransfersPk;

    /**
     * @var int|null
     */
    private $batchFk;

    /**
     * @var string
     */
    private $groupguid = 'newid()';

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var \DateTime|null
     */
    private $processdate;

    /**
     * @var string|null
     */
    private $warehousefrom;

    /**
     * @var string|null
     */
    private $warehouselocationfrom;

    /**
     * @var string|null
     */
    private $warehouseto;

    /**
     * @var string|null
     */
    private $warehouselocationto;

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
     * Get warehousetransfersPk.
     *
     * @return int
     */
    public function getWarehousetransfersPk()
    {
        return $this->warehousetransfersPk;
    }

    /**
     * Set batchFk.
     *
     * @param int|null $batchFk
     *
     * @return Warehousetransfers
     */
    public function setBatchFk($batchFk = null)
    {
        $this->batchFk = $batchFk;

        return $this;
    }

    /**
     * Get batchFk.
     *
     * @return int|null
     */
    public function getBatchFk()
    {
        return $this->batchFk;
    }

    /**
     * Set groupguid.
     *
     * @param string $groupguid
     *
     * @return Warehousetransfers
     */
    public function setGroupguid($groupguid)
    {
        $this->groupguid = $groupguid;

        return $this;
    }

    /**
     * Get groupguid.
     *
     * @return string
     */
    public function getGroupguid()
    {
        return $this->groupguid;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Warehousetransfers
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
     * Set processdate.
     *
     * @param \DateTime|null $processdate
     *
     * @return Warehousetransfers
     */
    public function setProcessdate($processdate = null)
    {
        $this->processdate = $processdate;

        return $this;
    }

    /**
     * Get processdate.
     *
     * @return \DateTime|null
     */
    public function getProcessdate()
    {
        return $this->processdate;
    }

    /**
     * Set warehousefrom.
     *
     * @param string|null $warehousefrom
     *
     * @return Warehousetransfers
     */
    public function setWarehousefrom($warehousefrom = null)
    {
        $this->warehousefrom = $warehousefrom;

        return $this;
    }

    /**
     * Get warehousefrom.
     *
     * @return string|null
     */
    public function getWarehousefrom()
    {
        return $this->warehousefrom;
    }

    /**
     * Set warehouselocationfrom.
     *
     * @param string|null $warehouselocationfrom
     *
     * @return Warehousetransfers
     */
    public function setWarehouselocationfrom($warehouselocationfrom = null)
    {
        $this->warehouselocationfrom = $warehouselocationfrom;

        return $this;
    }

    /**
     * Get warehouselocationfrom.
     *
     * @return string|null
     */
    public function getWarehouselocationfrom()
    {
        return $this->warehouselocationfrom;
    }

    /**
     * Set warehouseto.
     *
     * @param string|null $warehouseto
     *
     * @return Warehousetransfers
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
     * Set warehouselocationto.
     *
     * @param string|null $warehouselocationto
     *
     * @return Warehousetransfers
     */
    public function setWarehouselocationto($warehouselocationto = null)
    {
        $this->warehouselocationto = $warehouselocationto;

        return $this;
    }

    /**
     * Get warehouselocationto.
     *
     * @return string|null
     */
    public function getWarehouselocationto()
    {
        return $this->warehouselocationto;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Warehousetransfers
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
     * @return Warehousetransfers
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
     * @return Warehousetransfers
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
     * @return Warehousetransfers
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
     * @return Warehousetransfers
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
