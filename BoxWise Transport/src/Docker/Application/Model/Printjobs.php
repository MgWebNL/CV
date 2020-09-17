<?php

namespace PenD\Docker\Application\Model;

/**
 * Printjobs
 */
class Printjobs
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $externalid;

    /**
     * @var string
     */
    private $label;

    /**
     * @var int
     */
    private $status = '0';

    /**
     * @var string
     */
    private $printerid;

    /**
     * @var int|null
     */
    private $printruleid;

    /**
     * @var string|null
     */
    private $jobtype;

    /**
     * @var int
     */
    private $blobid;

    /**
     * @var int
     */
    private $documenttype = '0';

    /**
     * @var int
     */
    private $copies = '1';

    /**
     * @var int
     */
    private $colormode = '0';

    /**
     * @var int
     */
    private $duplexmode = '0';

    /**
     * @var int
     */
    private $pageorientation = '0';

    /**
     * @var string|null
     */
    private $bin;

    /**
     * @var string|null
     */
    private $pagesize;

    /**
     * @var int|null
     */
    private $zoneid;

    /**
     * @var int|null
     */
    private $userid;

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
     * @var int|null
     */
    private $printscaletype;


    /**
     * Get id.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set externalid.
     *
     * @param string|null $externalid
     *
     * @return Printjobs
     */
    public function setExternalid($externalid = null)
    {
        $this->externalid = $externalid;

        return $this;
    }

    /**
     * Get externalid.
     *
     * @return string|null
     */
    public function getExternalid()
    {
        return $this->externalid;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return Printjobs
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Printjobs
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
     * Set printerid.
     *
     * @param string $printerid
     *
     * @return Printjobs
     */
    public function setPrinterid($printerid)
    {
        $this->printerid = $printerid;

        return $this;
    }

    /**
     * Get printerid.
     *
     * @return string
     */
    public function getPrinterid()
    {
        return $this->printerid;
    }

    /**
     * Set printruleid.
     *
     * @param int|null $printruleid
     *
     * @return Printjobs
     */
    public function setPrintruleid($printruleid = null)
    {
        $this->printruleid = $printruleid;

        return $this;
    }

    /**
     * Get printruleid.
     *
     * @return int|null
     */
    public function getPrintruleid()
    {
        return $this->printruleid;
    }

    /**
     * Set jobtype.
     *
     * @param string|null $jobtype
     *
     * @return Printjobs
     */
    public function setJobtype($jobtype = null)
    {
        $this->jobtype = $jobtype;

        return $this;
    }

    /**
     * Get jobtype.
     *
     * @return string|null
     */
    public function getJobtype()
    {
        return $this->jobtype;
    }

    /**
     * Set blobid.
     *
     * @param int $blobid
     *
     * @return Printjobs
     */
    public function setBlobid($blobid)
    {
        $this->blobid = $blobid;

        return $this;
    }

    /**
     * Get blobid.
     *
     * @return int
     */
    public function getBlobid()
    {
        return $this->blobid;
    }

    /**
     * Set documenttype.
     *
     * @param int $documenttype
     *
     * @return Printjobs
     */
    public function setDocumenttype($documenttype)
    {
        $this->documenttype = $documenttype;

        return $this;
    }

    /**
     * Get documenttype.
     *
     * @return int
     */
    public function getDocumenttype()
    {
        return $this->documenttype;
    }

    /**
     * Set copies.
     *
     * @param int $copies
     *
     * @return Printjobs
     */
    public function setCopies($copies)
    {
        $this->copies = $copies;

        return $this;
    }

    /**
     * Get copies.
     *
     * @return int
     */
    public function getCopies()
    {
        return $this->copies;
    }

    /**
     * Set colormode.
     *
     * @param int $colormode
     *
     * @return Printjobs
     */
    public function setColormode($colormode)
    {
        $this->colormode = $colormode;

        return $this;
    }

    /**
     * Get colormode.
     *
     * @return int
     */
    public function getColormode()
    {
        return $this->colormode;
    }

    /**
     * Set duplexmode.
     *
     * @param int $duplexmode
     *
     * @return Printjobs
     */
    public function setDuplexmode($duplexmode)
    {
        $this->duplexmode = $duplexmode;

        return $this;
    }

    /**
     * Get duplexmode.
     *
     * @return int
     */
    public function getDuplexmode()
    {
        return $this->duplexmode;
    }

    /**
     * Set pageorientation.
     *
     * @param int $pageorientation
     *
     * @return Printjobs
     */
    public function setPageorientation($pageorientation)
    {
        $this->pageorientation = $pageorientation;

        return $this;
    }

    /**
     * Get pageorientation.
     *
     * @return int
     */
    public function getPageorientation()
    {
        return $this->pageorientation;
    }

    /**
     * Set bin.
     *
     * @param string|null $bin
     *
     * @return Printjobs
     */
    public function setBin($bin = null)
    {
        $this->bin = $bin;

        return $this;
    }

    /**
     * Get bin.
     *
     * @return string|null
     */
    public function getBin()
    {
        return $this->bin;
    }

    /**
     * Set pagesize.
     *
     * @param string|null $pagesize
     *
     * @return Printjobs
     */
    public function setPagesize($pagesize = null)
    {
        $this->pagesize = $pagesize;

        return $this;
    }

    /**
     * Get pagesize.
     *
     * @return string|null
     */
    public function getPagesize()
    {
        return $this->pagesize;
    }

    /**
     * Set zoneid.
     *
     * @param int|null $zoneid
     *
     * @return Printjobs
     */
    public function setZoneid($zoneid = null)
    {
        $this->zoneid = $zoneid;

        return $this;
    }

    /**
     * Get zoneid.
     *
     * @return int|null
     */
    public function getZoneid()
    {
        return $this->zoneid;
    }

    /**
     * Set userid.
     *
     * @param int|null $userid
     *
     * @return Printjobs
     */
    public function setUserid($userid = null)
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * Get userid.
     *
     * @return int|null
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Printjobs
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
     * @return Printjobs
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
     * @return Printjobs
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
     * @return Printjobs
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
     * @return Printjobs
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
     * Set printscaletype.
     *
     * @param int|null $printscaletype
     *
     * @return Printjobs
     */
    public function setPrintscaletype($printscaletype = null)
    {
        $this->printscaletype = $printscaletype;

        return $this;
    }

    /**
     * Get printscaletype.
     *
     * @return int|null
     */
    public function getPrintscaletype()
    {
        return $this->printscaletype;
    }
}
