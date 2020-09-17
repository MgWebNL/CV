<?php

namespace PenD\Docker\Application\Model;

/**
 * Devices
 */
class Devices
{
    /**
     * @var int
     */
    private $devicePk;

    /**
     * @var string
     */
    private $macaddress;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdon;

    /**
     * @var string
     */
    private $createdby;

    /**
     * @var \DateTime
     */
    private $modifiedon;

    /**
     * @var string
     */
    private $modifiedby;

    /**
     * @var string
     */
    private $rowversion;


    /**
     * Get devicePk.
     *
     * @return int
     */
    public function getDevicePk()
    {
        return $this->devicePk;
    }

    /**
     * Set macaddress.
     *
     * @param string $macaddress
     *
     * @return Devices
     */
    public function setMacaddress($macaddress)
    {
        $this->macaddress = $macaddress;

        return $this;
    }

    /**
     * Get macaddress.
     *
     * @return string
     */
    public function getMacaddress()
    {
        return $this->macaddress;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Devices
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Devices
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
     * @return Devices
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
     * @return Devices
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
     * @return Devices
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
     * @return Devices
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
