<?php

namespace PenD\Docker\Application\Model;

/**
 * Prereceipts
 */
class Prereceipts
{
    /**
     * @var int
     */
    private $prereceiptPk;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $datereceipt;

    /**
     * @var int
     */
    private $numberofcollo;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var string|null
     */
    private $tags;

    /**
     * @var int
     */
    private $status;

    /**
     * @var bool
     */
    private $hastransactionlines;

    /**
     * @var bool
     */
    private $isfullyreceived;

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
     * Get prereceiptPk.
     *
     * @return int
     */
    public function getPrereceiptPk()
    {
        return $this->prereceiptPk;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Prereceipts
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set datereceipt.
     *
     * @param \DateTime $datereceipt
     *
     * @return Prereceipts
     */
    public function setDatereceipt($datereceipt)
    {
        $this->datereceipt = $datereceipt;

        return $this;
    }

    /**
     * Get datereceipt.
     *
     * @return \DateTime
     */
    public function getDatereceipt()
    {
        return $this->datereceipt;
    }

    /**
     * Set numberofcollo.
     *
     * @param int $numberofcollo
     *
     * @return Prereceipts
     */
    public function setNumberofcollo($numberofcollo)
    {
        $this->numberofcollo = $numberofcollo;

        return $this;
    }

    /**
     * Get numberofcollo.
     *
     * @return int
     */
    public function getNumberofcollo()
    {
        return $this->numberofcollo;
    }

    /**
     * Set notes.
     *
     * @param string $notes
     *
     * @return Prereceipts
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes.
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set tags.
     *
     * @param string|null $tags
     *
     * @return Prereceipts
     */
    public function setTags($tags = null)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return string|null
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Prereceipts
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set hastransactionlines.
     *
     * @param bool $hastransactionlines
     *
     * @return Prereceipts
     */
    public function setHastransactionlines($hastransactionlines)
    {
        $this->hastransactionlines = $hastransactionlines;

        return $this;
    }

    /**
     * Get hastransactionlines.
     *
     * @return bool
     */
    public function getHastransactionlines()
    {
        return $this->hastransactionlines;
    }

    /**
     * Set isfullyreceived.
     *
     * @param bool $isfullyreceived
     *
     * @return Prereceipts
     */
    public function setIsfullyreceived($isfullyreceived)
    {
        $this->isfullyreceived = $isfullyreceived;

        return $this;
    }

    /**
     * Get isfullyreceived.
     *
     * @return bool
     */
    public function getIsfullyreceived()
    {
        return $this->isfullyreceived;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Prereceipts
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
     * @return Prereceipts
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
     * @return Prereceipts
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
     * @return Prereceipts
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
     * @return Prereceipts
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
