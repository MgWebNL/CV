<?php

namespace PenD\Docker\Application\Model;

/**
 * Itemmovements
 */
class Itemmovements
{
    /**
     * @var int
     */
    private $itemmovementsPk;

    /**
     * @var string|null
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var string|null
     */
    private $quantityin;

    /**
     * @var string|null
     */
    private $quantityout;

    /**
     * @var string|null
     */
    private $task;

    /**
     * @var string
     */
    private $fktable = '';

    /**
     * @var int
     */
    private $foreignkey = '-1';

    /**
     * @var string|null
     */
    private $warehousecode;

    /**
     * @var string|null
     */
    private $locationcode;

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
     * Get itemmovementsPk.
     *
     * @return int
     */
    public function getItemmovementsPk()
    {
        return $this->itemmovementsPk;
    }

    /**
     * Set itemcode.
     *
     * @param string|null $itemcode
     *
     * @return Itemmovements
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
     * Set itemdescription.
     *
     * @param string|null $itemdescription
     *
     * @return Itemmovements
     */
    public function setItemdescription($itemdescription = null)
    {
        $this->itemdescription = $itemdescription;

        return $this;
    }

    /**
     * Get itemdescription.
     *
     * @return string|null
     */
    public function getItemdescription()
    {
        return $this->itemdescription;
    }

    /**
     * Set quantityin.
     *
     * @param string|null $quantityin
     *
     * @return Itemmovements
     */
    public function setQuantityin($quantityin = null)
    {
        $this->quantityin = $quantityin;

        return $this;
    }

    /**
     * Get quantityin.
     *
     * @return string|null
     */
    public function getQuantityin()
    {
        return $this->quantityin;
    }

    /**
     * Set quantityout.
     *
     * @param string|null $quantityout
     *
     * @return Itemmovements
     */
    public function setQuantityout($quantityout = null)
    {
        $this->quantityout = $quantityout;

        return $this;
    }

    /**
     * Get quantityout.
     *
     * @return string|null
     */
    public function getQuantityout()
    {
        return $this->quantityout;
    }

    /**
     * Set task.
     *
     * @param string|null $task
     *
     * @return Itemmovements
     */
    public function setTask($task = null)
    {
        $this->task = $task;

        return $this;
    }

    /**
     * Get task.
     *
     * @return string|null
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set fktable.
     *
     * @param string $fktable
     *
     * @return Itemmovements
     */
    public function setFktable($fktable)
    {
        $this->fktable = $fktable;

        return $this;
    }

    /**
     * Get fktable.
     *
     * @return string
     */
    public function getFktable()
    {
        return $this->fktable;
    }

    /**
     * Set foreignkey.
     *
     * @param int $foreignkey
     *
     * @return Itemmovements
     */
    public function setForeignkey($foreignkey)
    {
        $this->foreignkey = $foreignkey;

        return $this;
    }

    /**
     * Get foreignkey.
     *
     * @return int
     */
    public function getForeignkey()
    {
        return $this->foreignkey;
    }

    /**
     * Set warehousecode.
     *
     * @param string|null $warehousecode
     *
     * @return Itemmovements
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
     * @return Itemmovements
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Itemmovements
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
     * @return Itemmovements
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
     * @return Itemmovements
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
     * @return Itemmovements
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
     * @return Itemmovements
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
