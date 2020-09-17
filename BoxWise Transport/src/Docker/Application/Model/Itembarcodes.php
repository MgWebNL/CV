<?php

namespace PenD\Docker\Application\Model;

/**
 * Itembarcodes
 */
class Itembarcodes
{
    /**
     * @var int
     */
    private $itembarcodePk;

    /**
     * @var string
     */
    private $fixationtype;

    /**
     * @var string
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $barcode;

    /**
     * @var string
     */
    private $unitcode;

    /**
     * @var string
     */
    private $unitname;

    /**
     * @var string|null
     */
    private $attributeid;

    /**
     * @var string|null
     */
    private $attributename;

    /**
     * @var string
     */
    private $factor;

    /**
     * @var int
     */
    private $itemtype;

    /**
     * @var string
     */
    private $key;

    /**
     * @var int
     */
    private $hashcode;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var int
     */
    private $synccount = '0';

    /**
     * @var string|null
     */
    private $lastsyncerror;

    /**
     * @var string|null
     */
    private $formerbarcode;

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
     * @var string|null
     */
    private $customfields;


    /**
     * Get itembarcodePk.
     *
     * @return int
     */
    public function getItembarcodePk()
    {
        return $this->itembarcodePk;
    }

    /**
     * Set fixationtype.
     *
     * @param string $fixationtype
     *
     * @return Itembarcodes
     */
    public function setFixationtype($fixationtype)
    {
        $this->fixationtype = $fixationtype;

        return $this;
    }

    /**
     * Get fixationtype.
     *
     * @return string
     */
    public function getFixationtype()
    {
        return $this->fixationtype;
    }

    /**
     * Set itemcode.
     *
     * @param string $itemcode
     *
     * @return Itembarcodes
     */
    public function setItemcode($itemcode)
    {
        $this->itemcode = $itemcode;

        return $this;
    }

    /**
     * Get itemcode.
     *
     * @return string
     */
    public function getItemcode()
    {
        return $this->itemcode;
    }

    /**
     * Set barcode.
     *
     * @param string|null $barcode
     *
     * @return Itembarcodes
     */
    public function setBarcode($barcode = null)
    {
        $this->barcode = $barcode;

        return $this;
    }

    /**
     * Get barcode.
     *
     * @return string|null
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * Set unitcode.
     *
     * @param string $unitcode
     *
     * @return Itembarcodes
     */
    public function setUnitcode($unitcode)
    {
        $this->unitcode = $unitcode;

        return $this;
    }

    /**
     * Get unitcode.
     *
     * @return string
     */
    public function getUnitcode()
    {
        return $this->unitcode;
    }

    /**
     * Set unitname.
     *
     * @param string $unitname
     *
     * @return Itembarcodes
     */
    public function setUnitname($unitname)
    {
        $this->unitname = $unitname;

        return $this;
    }

    /**
     * Get unitname.
     *
     * @return string
     */
    public function getUnitname()
    {
        return $this->unitname;
    }

    /**
     * Set attributeid.
     *
     * @param string|null $attributeid
     *
     * @return Itembarcodes
     */
    public function setAttributeid($attributeid = null)
    {
        $this->attributeid = $attributeid;

        return $this;
    }

    /**
     * Get attributeid.
     *
     * @return string|null
     */
    public function getAttributeid()
    {
        return $this->attributeid;
    }

    /**
     * Set attributename.
     *
     * @param string|null $attributename
     *
     * @return Itembarcodes
     */
    public function setAttributename($attributename = null)
    {
        $this->attributename = $attributename;

        return $this;
    }

    /**
     * Get attributename.
     *
     * @return string|null
     */
    public function getAttributename()
    {
        return $this->attributename;
    }

    /**
     * Set factor.
     *
     * @param string $factor
     *
     * @return Itembarcodes
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;

        return $this;
    }

    /**
     * Get factor.
     *
     * @return string
     */
    public function getFactor()
    {
        return $this->factor;
    }

    /**
     * Set itemtype.
     *
     * @param int $itemtype
     *
     * @return Itembarcodes
     */
    public function setItemtype($itemtype)
    {
        $this->itemtype = $itemtype;

        return $this;
    }

    /**
     * Get itemtype.
     *
     * @return int
     */
    public function getItemtype()
    {
        return $this->itemtype;
    }

    /**
     * Set key.
     *
     * @param string $key
     *
     * @return Itembarcodes
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set hashcode.
     *
     * @param int $hashcode
     *
     * @return Itembarcodes
     */
    public function setHashcode($hashcode)
    {
        $this->hashcode = $hashcode;

        return $this;
    }

    /**
     * Get hashcode.
     *
     * @return int
     */
    public function getHashcode()
    {
        return $this->hashcode;
    }

    /**
     * Set status.
     *
     * @param string|null $status
     *
     * @return Itembarcodes
     */
    public function setStatus($status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set synccount.
     *
     * @param int $synccount
     *
     * @return Itembarcodes
     */
    public function setSynccount($synccount)
    {
        $this->synccount = $synccount;

        return $this;
    }

    /**
     * Get synccount.
     *
     * @return int
     */
    public function getSynccount()
    {
        return $this->synccount;
    }

    /**
     * Set lastsyncerror.
     *
     * @param string|null $lastsyncerror
     *
     * @return Itembarcodes
     */
    public function setLastsyncerror($lastsyncerror = null)
    {
        $this->lastsyncerror = $lastsyncerror;

        return $this;
    }

    /**
     * Get lastsyncerror.
     *
     * @return string|null
     */
    public function getLastsyncerror()
    {
        return $this->lastsyncerror;
    }

    /**
     * Set formerbarcode.
     *
     * @param string|null $formerbarcode
     *
     * @return Itembarcodes
     */
    public function setFormerbarcode($formerbarcode = null)
    {
        $this->formerbarcode = $formerbarcode;

        return $this;
    }

    /**
     * Get formerbarcode.
     *
     * @return string|null
     */
    public function getFormerbarcode()
    {
        return $this->formerbarcode;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Itembarcodes
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
     * @return Itembarcodes
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
     * @return Itembarcodes
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
     * @return Itembarcodes
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
     * @return Itembarcodes
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
     * Set customfields.
     *
     * @param string|null $customfields
     *
     * @return Itembarcodes
     */
    public function setCustomfields($customfields = null)
    {
        $this->customfields = $customfields;

        return $this;
    }

    /**
     * Get customfields.
     *
     * @return string|null
     */
    public function getCustomfields()
    {
        return $this->customfields;
    }
}
