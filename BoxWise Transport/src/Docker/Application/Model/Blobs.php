<?php

namespace PenD\Docker\Application\Model;

/**
 * Blobs
 */
class Blobs
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $containername;

    /**
     * @var string
     */
    private $blobname;

    /**
     * @var string|null
     */
    private $originalfilename;

    /**
     * @var string
     */
    private $mimetype;

    /**
     * @var int
     */
    private $filesize;

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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set containername.
     *
     * @param string $containername
     *
     * @return Blobs
     */
    public function setContainername($containername)
    {
        $this->containername = $containername;

        return $this;
    }

    /**
     * Get containername.
     *
     * @return string
     */
    public function getContainername()
    {
        return $this->containername;
    }

    /**
     * Set blobname.
     *
     * @param string $blobname
     *
     * @return Blobs
     */
    public function setBlobname($blobname)
    {
        $this->blobname = $blobname;

        return $this;
    }

    /**
     * Get blobname.
     *
     * @return string
     */
    public function getBlobname()
    {
        return $this->blobname;
    }

    /**
     * Set originalfilename.
     *
     * @param string|null $originalfilename
     *
     * @return Blobs
     */
    public function setOriginalfilename($originalfilename = null)
    {
        $this->originalfilename = $originalfilename;

        return $this;
    }

    /**
     * Get originalfilename.
     *
     * @return string|null
     */
    public function getOriginalfilename()
    {
        return $this->originalfilename;
    }

    /**
     * Set mimetype.
     *
     * @param string $mimetype
     *
     * @return Blobs
     */
    public function setMimetype($mimetype)
    {
        $this->mimetype = $mimetype;

        return $this;
    }

    /**
     * Get mimetype.
     *
     * @return string
     */
    public function getMimetype()
    {
        return $this->mimetype;
    }

    /**
     * Set filesize.
     *
     * @param int $filesize
     *
     * @return Blobs
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize.
     *
     * @return int
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Blobs
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
     * @return Blobs
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
     * @return Blobs
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
     * @return Blobs
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
     * @return Blobs
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
