<?php

namespace PenD\Docker\Application\Model;

/**
 * Licenseplateitems
 */
class Licenseplateitems
{
    /**
     * @var int
     */
    private $licenseplateitemPk;

    /**
     * @var string|null
     */
    private $itemcode;

    /**
     * @var string|null
     */
    private $itemdescription;

    /**
     * @var bool
     */
    private $isserialitem = '0';

    /**
     * @var bool
     */
    private $isbatchitem = '0';

    /**
     * @var string|null
     */
    private $itemid;

    /**
     * @var string|null
     */
    private $quantity;

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
     * @var \PenD\Docker\Application\Model\Licenseplates
     */
    private $licenseplateFk;


    /**
     * Get licenseplateitemPk.
     *
     * @return int
     */
    public function getLicenseplateitemPk()
    {
        return $this->licenseplateitemPk;
    }

    /**
     * Set itemcode.
     *
     * @param string|null $itemcode
     *
     * @return Licenseplateitems
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
     * @return Licenseplateitems
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
     * Set isserialitem.
     *
     * @param bool $isserialitem
     *
     * @return Licenseplateitems
     */
    public function setIsserialitem($isserialitem)
    {
        $this->isserialitem = $isserialitem;

        return $this;
    }

    /**
     * Get isserialitem.
     *
     * @return bool
     */
    public function getIsserialitem()
    {
        return $this->isserialitem;
    }

    /**
     * Set isbatchitem.
     *
     * @param bool $isbatchitem
     *
     * @return Licenseplateitems
     */
    public function setIsbatchitem($isbatchitem)
    {
        $this->isbatchitem = $isbatchitem;

        return $this;
    }

    /**
     * Get isbatchitem.
     *
     * @return bool
     */
    public function getIsbatchitem()
    {
        return $this->isbatchitem;
    }

    /**
     * Set itemid.
     *
     * @param string|null $itemid
     *
     * @return Licenseplateitems
     */
    public function setItemid($itemid = null)
    {
        $this->itemid = $itemid;

        return $this;
    }

    /**
     * Get itemid.
     *
     * @return string|null
     */
    public function getItemid()
    {
        return $this->itemid;
    }

    /**
     * Set quantity.
     *
     * @param string|null $quantity
     *
     * @return Licenseplateitems
     */
    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return string|null
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
     * @return Licenseplateitems
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
     * @return Licenseplateitems
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
     * @return Licenseplateitems
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
     * @return Licenseplateitems
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
     * @return Licenseplateitems
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
     * Set licenseplateFk.
     *
     * @param \PenD\Docker\Application\Model\Licenseplates|null $licenseplateFk
     *
     * @return Licenseplateitems
     */
    public function setLicenseplateFk(\PenD\Docker\Application\Model\Licenseplates $licenseplateFk = null)
    {
        $this->licenseplateFk = $licenseplateFk;

        return $this;
    }

    /**
     * Get licenseplateFk.
     *
     * @return \PenD\Docker\Application\Model\Licenseplates|null
     */
    public function getLicenseplateFk()
    {
        return $this->licenseplateFk;
    }
}
