<?php

namespace PenD\Docker\Application\Model;

/**
 * Prereceipttransactions
 */
class Prereceipttransactions
{
    /**
     * @var int
     */
    private $prereceipttransactionPk;

    /**
     * @var int
     */
    private $prereceiptlineFk;

    /**
     * @var string
     */
    private $transactionid;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var \DateTime|null
     */
    private $enddate;

    /**
     * @var bool
     */
    private $ishandled = '0';

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
     * Get prereceipttransactionPk.
     *
     * @return int
     */
    public function getPrereceipttransactionPk()
    {
        return $this->prereceipttransactionPk;
    }

    /**
     * Set prereceiptlineFk.
     *
     * @param int $prereceiptlineFk
     *
     * @return Prereceipttransactions
     */
    public function setPrereceiptlineFk($prereceiptlineFk)
    {
        $this->prereceiptlineFk = $prereceiptlineFk;

        return $this;
    }

    /**
     * Get prereceiptlineFk.
     *
     * @return int
     */
    public function getPrereceiptlineFk()
    {
        return $this->prereceiptlineFk;
    }

    /**
     * Set transactionid.
     *
     * @param string $transactionid
     *
     * @return Prereceipttransactions
     */
    public function setTransactionid($transactionid)
    {
        $this->transactionid = $transactionid;

        return $this;
    }

    /**
     * Get transactionid.
     *
     * @return string
     */
    public function getTransactionid()
    {
        return $this->transactionid;
    }

    /**
     * Set number.
     *
     * @param string|null $number
     *
     * @return Prereceipttransactions
     */
    public function setNumber($number = null)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return Prereceipttransactions
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Prereceipttransactions
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
     * Set enddate.
     *
     * @param \DateTime|null $enddate
     *
     * @return Prereceipttransactions
     */
    public function setEnddate($enddate = null)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate.
     *
     * @return \DateTime|null
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * Set ishandled.
     *
     * @param bool $ishandled
     *
     * @return Prereceipttransactions
     */
    public function setIshandled($ishandled)
    {
        $this->ishandled = $ishandled;

        return $this;
    }

    /**
     * Get ishandled.
     *
     * @return bool
     */
    public function getIshandled()
    {
        return $this->ishandled;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Prereceipttransactions
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
     * @return Prereceipttransactions
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
     * @return Prereceipttransactions
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
     * @return Prereceipttransactions
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
     * @return Prereceipttransactions
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
