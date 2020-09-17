<?php

namespace PenD\Docker\Application\Model;

/**
 * Itemids
 */
class Itemids
{
    /**
     * @var int
     */
    private $itemidPk;

    /**
     * @var int|null
     */
    private $itemmovementFk;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string
     */
    private $quantity = '0';

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
     * @var \DateTime|null
     */
    private $begindate;

    /**
     * @var \DateTime|null
     */
    private $enddate;


    /**
     * Get itemidPk.
     *
     * @return int
     */
    public function getItemidPk()
    {
        return $this->itemidPk;
    }

    /**
     * Set itemmovementFk.
     *
     * @param int|null $itemmovementFk
     *
     * @return Itemids
     */
    public function setItemmovementFk($itemmovementFk = null)
    {
        $this->itemmovementFk = $itemmovementFk;

        return $this;
    }

    /**
     * Get itemmovementFk.
     *
     * @return int|null
     */
    public function getItemmovementFk()
    {
        return $this->itemmovementFk;
    }

    /**
     * Set number.
     *
     * @param string|null $number
     *
     * @return Itemids
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
     * @return Itemids
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
     * Set description.
     *
     * @param string|null $description
     *
     * @return Itemids
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
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Itemids
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Itemids
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
     * @return Itemids
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
     * @return Itemids
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
     * @return Itemids
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
     * @return Itemids
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
     * Set begindate.
     *
     * @param \DateTime|null $begindate
     *
     * @return Itemids
     */
    public function setBegindate($begindate = null)
    {
        $this->begindate = $begindate;

        return $this;
    }

    /**
     * Get begindate.
     *
     * @return \DateTime|null
     */
    public function getBegindate()
    {
        return $this->begindate;
    }

    /**
     * Set enddate.
     *
     * @param \DateTime|null $enddate
     *
     * @return Itemids
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
}
