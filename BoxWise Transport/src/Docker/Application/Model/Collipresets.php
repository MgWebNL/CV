<?php

namespace PenD\Docker\Application\Model;

/**
 * Collipresets
 */
class Collipresets
{
    /**
     * @var int
     */
    private $collipresetsPk;

    /**
     * @var int
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $length;

    /**
     * @var string|null
     */
    private $width;

    /**
     * @var string|null
     */
    private $height;

    /**
     * @var string|null
     */
    private $weight;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var bool
     */
    private $isdefault = '0';

    /**
     * @var string|null
     */
    private $collispecificationcode;

    /**
     * @var string|null
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $barcode;

    /**
     * @var int
     */
    private $stockregistration = '0';

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
     * Get collipresetsPk.
     *
     * @return int
     */
    public function getCollipresetsPk()
    {
        return $this->collipresetsPk;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return Collipresets
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Collipresets
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set length.
     *
     * @param string|null $length
     *
     * @return Collipresets
     */
    public function setLength($length = null)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length.
     *
     * @return string|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set width.
     *
     * @param string|null $width
     *
     * @return Collipresets
     */
    public function setWidth($width = null)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width.
     *
     * @return string|null
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height.
     *
     * @param string|null $height
     *
     * @return Collipresets
     */
    public function setHeight($height = null)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height.
     *
     * @return string|null
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set weight.
     *
     * @param string|null $weight
     *
     * @return Collipresets
     */
    public function setWeight($weight = null)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight.
     *
     * @return string|null
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Collipresets
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set isdefault.
     *
     * @param bool $isdefault
     *
     * @return Collipresets
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    /**
     * Get isdefault.
     *
     * @return bool
     */
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * Set collispecificationcode.
     *
     * @param string|null $collispecificationcode
     *
     * @return Collipresets
     */
    public function setCollispecificationcode($collispecificationcode = null)
    {
        $this->collispecificationcode = $collispecificationcode;

        return $this;
    }

    /**
     * Get collispecificationcode.
     *
     * @return string|null
     */
    public function getCollispecificationcode()
    {
        return $this->collispecificationcode;
    }

    /**
     * Set itemcode.
     *
     * @param string|null $itemcode
     *
     * @return Collipresets
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
     * Set barcode.
     *
     * @param string|null $barcode
     *
     * @return Collipresets
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
     * Set stockregistration.
     *
     * @param int $stockregistration
     *
     * @return Collipresets
     */
    public function setStockregistration($stockregistration)
    {
        $this->stockregistration = $stockregistration;

        return $this;
    }

    /**
     * Get stockregistration.
     *
     * @return int
     */
    public function getStockregistration()
    {
        return $this->stockregistration;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Collipresets
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
     * @return Collipresets
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
     * @return Collipresets
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
     * @return Collipresets
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
     * @return Collipresets
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
