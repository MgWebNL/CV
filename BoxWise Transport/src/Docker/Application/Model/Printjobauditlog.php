<?php

namespace PenD\Docker\Application\Model;

/**
 * Printjobauditlog
 */
class Printjobauditlog
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $oldstatus;

    /**
     * @var int
     */
    private $newstatus;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $statuschangedon = 'CURRENT_TIMESTAMP';

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
     * @var \PenD\Docker\Application\Model\Printjobs
     */
    private $printjobid;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set oldstatus.
     *
     * @param int $oldstatus
     *
     * @return Printjobauditlog
     */
    public function setOldstatus($oldstatus)
    {
        $this->oldstatus = $oldstatus;

        return $this;
    }

    /**
     * Get oldstatus.
     *
     * @return int
     */
    public function getOldstatus()
    {
        return $this->oldstatus;
    }

    /**
     * Set newstatus.
     *
     * @param int $newstatus
     *
     * @return Printjobauditlog
     */
    public function setNewstatus($newstatus)
    {
        $this->newstatus = $newstatus;

        return $this;
    }

    /**
     * Get newstatus.
     *
     * @return int
     */
    public function getNewstatus()
    {
        return $this->newstatus;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Printjobauditlog
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
     * Set statuschangedon.
     *
     * @param \DateTime $statuschangedon
     *
     * @return Printjobauditlog
     */
    public function setStatuschangedon($statuschangedon)
    {
        $this->statuschangedon = $statuschangedon;

        return $this;
    }

    /**
     * Get statuschangedon.
     *
     * @return \DateTime
     */
    public function getStatuschangedon()
    {
        return $this->statuschangedon;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Printjobauditlog
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
     * @return Printjobauditlog
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
     * @return Printjobauditlog
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
     * @return Printjobauditlog
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
     * @return Printjobauditlog
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
     * Set printjobid.
     *
     * @param \PenD\Docker\Application\Model\Printjobs|null $printjobid
     *
     * @return Printjobauditlog
     */
    public function setPrintjobid(\PenD\Docker\Application\Model\Printjobs $printjobid = null)
    {
        $this->printjobid = $printjobid;

        return $this;
    }

    /**
     * Get printjobid.
     *
     * @return \PenD\Docker\Application\Model\Printjobs|null
     */
    public function getPrintjobid()
    {
        return $this->printjobid;
    }
}
