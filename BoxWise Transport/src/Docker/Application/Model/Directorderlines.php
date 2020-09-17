<?php

namespace PenD\Docker\Application\Model;

/**
 * Directorderlines
 */
class Directorderlines
{
    /**
     * @var int
     */
    private $directorderlinesPk;

    /**
     * @var string
     */
    private $warehouselocationcode;

    /**
     * @var int
     */
    private $linenumber;

    /**
     * @var string
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var string
     */
    private $quantity;

    /**
     * @var bool
     */
    private $isbatchnumberitem;

    /**
     * @var bool
     */
    private $isserialnumberitem;

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
     * @var \PenD\Docker\Application\Model\Directorders
     */
    private $directorderFk;


    /**
     * Get directorderlinesPk.
     *
     * @return int
     */
    public function getDirectorderlinesPk()
    {
        return $this->directorderlinesPk;
    }

    /**
     * Set warehouselocationcode.
     *
     * @param string $warehouselocationcode
     *
     * @return Directorderlines
     */
    public function setWarehouselocationcode($warehouselocationcode)
    {
        $this->warehouselocationcode = $warehouselocationcode;

        return $this;
    }

    /**
     * Get warehouselocationcode.
     *
     * @return string
     */
    public function getWarehouselocationcode()
    {
        return $this->warehouselocationcode;
    }

    /**
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Directorderlines
     */
    public function setLinenumber($linenumber)
    {
        $this->linenumber = $linenumber;

        return $this;
    }

    /**
     * Get linenumber.
     *
     * @return int
     */
    public function getLinenumber()
    {
        return $this->linenumber;
    }

    /**
     * Set itemcode.
     *
     * @param string $itemcode
     *
     * @return Directorderlines
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
     * Set itemdescription.
     *
     * @param string|null $itemdescription
     *
     * @return Directorderlines
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
     * Set quantity.
     *
     * @param string $quantity
     *
     * @return Directorderlines
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
     * Set isbatchnumberitem.
     *
     * @param bool $isbatchnumberitem
     *
     * @return Directorderlines
     */
    public function setIsbatchnumberitem($isbatchnumberitem)
    {
        $this->isbatchnumberitem = $isbatchnumberitem;

        return $this;
    }

    /**
     * Get isbatchnumberitem.
     *
     * @return bool
     */
    public function getIsbatchnumberitem()
    {
        return $this->isbatchnumberitem;
    }

    /**
     * Set isserialnumberitem.
     *
     * @param bool $isserialnumberitem
     *
     * @return Directorderlines
     */
    public function setIsserialnumberitem($isserialnumberitem)
    {
        $this->isserialnumberitem = $isserialnumberitem;

        return $this;
    }

    /**
     * Get isserialnumberitem.
     *
     * @return bool
     */
    public function getIsserialnumberitem()
    {
        return $this->isserialnumberitem;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Directorderlines
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
     * @return Directorderlines
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
     * @return Directorderlines
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
     * @return Directorderlines
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
     * @return Directorderlines
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
     * Set directorderFk.
     *
     * @param \PenD\Docker\Application\Model\Directorders|null $directorderFk
     *
     * @return Directorderlines
     */
    public function setDirectorderFk(\PenD\Docker\Application\Model\Directorders $directorderFk = null)
    {
        $this->directorderFk = $directorderFk;

        return $this;
    }

    /**
     * Get directorderFk.
     *
     * @return \PenD\Docker\Application\Model\Directorders|null
     */
    public function getDirectorderFk()
    {
        return $this->directorderFk;
    }
}
