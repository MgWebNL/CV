<?php

namespace PenD\Docker\Application\Model;

/**
 * Batches
 */
class Batches
{
    /**
     * @var int
     */
    private $batchesPk;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $notes;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var int|null
     */
    private $zoneFk;

    /**
     * @var int|null
     */
    private $userFk;

    /**
     * @var int|null
     */
    private $assigneduserFk;

    /**
     * @var \DateTime|null
     */
    private $pickstartedon;

    /**
     * @var \DateTime|null
     */
    private $pickfinishedon;

    /**
     * @var \DateTime|null
     */
    private $packstartedon;

    /**
     * @var \DateTime|null
     */
    private $packfinishedon;

    /**
     * @var \DateTime|null
     */
    private $batchcreatedon;

    /**
     * @var \DateTime|null
     */
    private $batchfinishedon;

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
     * Get batchesPk.
     *
     * @return int
     */
    public function getBatchesPk()
    {
        return $this->batchesPk;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Batches
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
     * Set description.
     *
     * @param string|null $description
     *
     * @return Batches
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
     * Set notes.
     *
     * @param string|null $notes
     *
     * @return Batches
     */
    public function setNotes($notes = null)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Batches
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
     * Set zoneFk.
     *
     * @param int|null $zoneFk
     *
     * @return Batches
     */
    public function setZoneFk($zoneFk = null)
    {
        $this->zoneFk = $zoneFk;

        return $this;
    }

    /**
     * Get zoneFk.
     *
     * @return int|null
     */
    public function getZoneFk()
    {
        return $this->zoneFk;
    }

    /**
     * Set userFk.
     *
     * @param int|null $userFk
     *
     * @return Batches
     */
    public function setUserFk($userFk = null)
    {
        $this->userFk = $userFk;

        return $this;
    }

    /**
     * Get userFk.
     *
     * @return int|null
     */
    public function getUserFk()
    {
        return $this->userFk;
    }

    /**
     * Set assigneduserFk.
     *
     * @param int|null $assigneduserFk
     *
     * @return Batches
     */
    public function setAssigneduserFk($assigneduserFk = null)
    {
        $this->assigneduserFk = $assigneduserFk;

        return $this;
    }

    /**
     * Get assigneduserFk.
     *
     * @return int|null
     */
    public function getAssigneduserFk()
    {
        return $this->assigneduserFk;
    }

    /**
     * Set pickstartedon.
     *
     * @param \DateTime|null $pickstartedon
     *
     * @return Batches
     */
    public function setPickstartedon($pickstartedon = null)
    {
        $this->pickstartedon = $pickstartedon;

        return $this;
    }

    /**
     * Get pickstartedon.
     *
     * @return \DateTime|null
     */
    public function getPickstartedon()
    {
        return $this->pickstartedon;
    }

    /**
     * Set pickfinishedon.
     *
     * @param \DateTime|null $pickfinishedon
     *
     * @return Batches
     */
    public function setPickfinishedon($pickfinishedon = null)
    {
        $this->pickfinishedon = $pickfinishedon;

        return $this;
    }

    /**
     * Get pickfinishedon.
     *
     * @return \DateTime|null
     */
    public function getPickfinishedon()
    {
        return $this->pickfinishedon;
    }

    /**
     * Set packstartedon.
     *
     * @param \DateTime|null $packstartedon
     *
     * @return Batches
     */
    public function setPackstartedon($packstartedon = null)
    {
        $this->packstartedon = $packstartedon;

        return $this;
    }

    /**
     * Get packstartedon.
     *
     * @return \DateTime|null
     */
    public function getPackstartedon()
    {
        return $this->packstartedon;
    }

    /**
     * Set packfinishedon.
     *
     * @param \DateTime|null $packfinishedon
     *
     * @return Batches
     */
    public function setPackfinishedon($packfinishedon = null)
    {
        $this->packfinishedon = $packfinishedon;

        return $this;
    }

    /**
     * Get packfinishedon.
     *
     * @return \DateTime|null
     */
    public function getPackfinishedon()
    {
        return $this->packfinishedon;
    }

    /**
     * Set batchcreatedon.
     *
     * @param \DateTime|null $batchcreatedon
     *
     * @return Batches
     */
    public function setBatchcreatedon($batchcreatedon = null)
    {
        $this->batchcreatedon = $batchcreatedon;

        return $this;
    }

    /**
     * Get batchcreatedon.
     *
     * @return \DateTime|null
     */
    public function getBatchcreatedon()
    {
        return $this->batchcreatedon;
    }

    /**
     * Set batchfinishedon.
     *
     * @param \DateTime|null $batchfinishedon
     *
     * @return Batches
     */
    public function setBatchfinishedon($batchfinishedon = null)
    {
        $this->batchfinishedon = $batchfinishedon;

        return $this;
    }

    /**
     * Get batchfinishedon.
     *
     * @return \DateTime|null
     */
    public function getBatchfinishedon()
    {
        return $this->batchfinishedon;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Batches
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
     * @return Batches
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
     * @return Batches
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
     * @return Batches
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
     * @return Batches
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
