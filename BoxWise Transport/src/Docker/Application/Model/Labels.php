<?php

namespace PenD\Docker\Application\Model;

/**
 * Labels
 */
class Labels
{
    /**
     * @var int
     */
    private $labelPk;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $image;

    /**
     * @var string
     */
    private $printercode;

    /**
     * @var string|null
     */
    private $fieldregex;

    /**
     * @var string|null
     */
    private $datasettypename;

    /**
     * @var string|null
     */
    private $mapping;

    /**
     * @var bool
     */
    private $sys = '0';

    /**
     * @var bool
     */
    private $onelabelperprintaction = '0';

    /**
     * @var bool
     */
    private $isactive = true;

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
     * Get labelPk.
     *
     * @return int
     */
    public function getLabelPk()
    {
        return $this->labelPk;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Labels
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
     * Set description.
     *
     * @param string|null $description
     *
     * @return Labels
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
     * Set image.
     *
     * @param string|null $image
     *
     * @return Labels
     */
    public function setImage($image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return string|null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set printercode.
     *
     * @param string $printercode
     *
     * @return Labels
     */
    public function setPrintercode($printercode)
    {
        $this->printercode = $printercode;

        return $this;
    }

    /**
     * Get printercode.
     *
     * @return string
     */
    public function getPrintercode()
    {
        return $this->printercode;
    }

    /**
     * Set fieldregex.
     *
     * @param string|null $fieldregex
     *
     * @return Labels
     */
    public function setFieldregex($fieldregex = null)
    {
        $this->fieldregex = $fieldregex;

        return $this;
    }

    /**
     * Get fieldregex.
     *
     * @return string|null
     */
    public function getFieldregex()
    {
        return $this->fieldregex;
    }

    /**
     * Set datasettypename.
     *
     * @param string|null $datasettypename
     *
     * @return Labels
     */
    public function setDatasettypename($datasettypename = null)
    {
        $this->datasettypename = $datasettypename;

        return $this;
    }

    /**
     * Get datasettypename.
     *
     * @return string|null
     */
    public function getDatasettypename()
    {
        return $this->datasettypename;
    }

    /**
     * Set mapping.
     *
     * @param string|null $mapping
     *
     * @return Labels
     */
    public function setMapping($mapping = null)
    {
        $this->mapping = $mapping;

        return $this;
    }

    /**
     * Get mapping.
     *
     * @return string|null
     */
    public function getMapping()
    {
        return $this->mapping;
    }

    /**
     * Set sys.
     *
     * @param bool $sys
     *
     * @return Labels
     */
    public function setSys($sys)
    {
        $this->sys = $sys;

        return $this;
    }

    /**
     * Get sys.
     *
     * @return bool
     */
    public function getSys()
    {
        return $this->sys;
    }

    /**
     * Set onelabelperprintaction.
     *
     * @param bool $onelabelperprintaction
     *
     * @return Labels
     */
    public function setOnelabelperprintaction($onelabelperprintaction)
    {
        $this->onelabelperprintaction = $onelabelperprintaction;

        return $this;
    }

    /**
     * Get onelabelperprintaction.
     *
     * @return bool
     */
    public function getOnelabelperprintaction()
    {
        return $this->onelabelperprintaction;
    }

    /**
     * Set isactive.
     *
     * @param bool $isactive
     *
     * @return Labels
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Labels
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
     * @return Labels
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
     * @return Labels
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
     * @return Labels
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
     * @return Labels
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
