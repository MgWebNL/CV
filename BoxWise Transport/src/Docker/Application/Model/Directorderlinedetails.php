<?php

namespace PenD\Docker\Application\Model;

/**
 * Directorderlinedetails
 */
class Directorderlinedetails
{
    /**
     * @var int
     */
    private $directorderlinedetailsPk;

    /**
     * @var string
     */
    private $itemidentificationnumber;

    /**
     * @var string
     */
    private $itemidentificationquantity;

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
     * @var \PenD\Docker\Application\Model\Directorderlines
     */
    private $directorderlineFk;


    /**
     * Get directorderlinedetailsPk.
     *
     * @return int
     */
    public function getDirectorderlinedetailsPk()
    {
        return $this->directorderlinedetailsPk;
    }

    /**
     * Set itemidentificationnumber.
     *
     * @param string $itemidentificationnumber
     *
     * @return Directorderlinedetails
     */
    public function setItemidentificationnumber($itemidentificationnumber)
    {
        $this->itemidentificationnumber = $itemidentificationnumber;

        return $this;
    }

    /**
     * Get itemidentificationnumber.
     *
     * @return string
     */
    public function getItemidentificationnumber()
    {
        return $this->itemidentificationnumber;
    }

    /**
     * Set itemidentificationquantity.
     *
     * @param string $itemidentificationquantity
     *
     * @return Directorderlinedetails
     */
    public function setItemidentificationquantity($itemidentificationquantity)
    {
        $this->itemidentificationquantity = $itemidentificationquantity;

        return $this;
    }

    /**
     * Get itemidentificationquantity.
     *
     * @return string
     */
    public function getItemidentificationquantity()
    {
        return $this->itemidentificationquantity;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Directorderlinedetails
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
     * @return Directorderlinedetails
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
     * @return Directorderlinedetails
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
     * @return Directorderlinedetails
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
     * @return Directorderlinedetails
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
     * Set directorderlineFk.
     *
     * @param \PenD\Docker\Application\Model\Directorderlines|null $directorderlineFk
     *
     * @return Directorderlinedetails
     */
    public function setDirectorderlineFk(\PenD\Docker\Application\Model\Directorderlines $directorderlineFk = null)
    {
        $this->directorderlineFk = $directorderlineFk;

        return $this;
    }

    /**
     * Get directorderlineFk.
     *
     * @return \PenD\Docker\Application\Model\Directorderlines|null
     */
    public function getDirectorderlineFk()
    {
        return $this->directorderlineFk;
    }
}
