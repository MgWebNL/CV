<?php

namespace PenD\Docker\Application\Model;

/**
 * Printrules
 */
class Printrules
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var bool
     */
    private $issystem = '0';

    /**
     * @var bool
     */
    private $isactive = true;

    /**
     * @var string
     */
    private $printerid;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $jobtype;

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
    private $duplexmode = '1';

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Printrules
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
     * Set issystem.
     *
     * @param bool $issystem
     *
     * @return Printrules
     */
    public function setIssystem($issystem)
    {
        $this->issystem = $issystem;

        return $this;
    }

    /**
     * Get issystem.
     *
     * @return bool
     */
    public function getIssystem()
    {
        return $this->issystem;
    }

    /**
     * Set isactive.
     *
     * @param bool $isactive
     *
     * @return Printrules
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive.
     *
     * @return bool
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Set printerid.
     *
     * @param string $printerid
     *
     * @return Printrules
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
     * Set label.
     *
     * @param string|null $label
     *
     * @return Printrules
     */
    public function setLabel($label = null)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set jobtype.
     *
     * @param string|null $jobtype
     *
     * @return Printrules
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
     * Set documenttype.
     *
     * @param int $documenttype
     *
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
     * @return Printrules
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
