<?php

namespace PenD\Docker\Application\Model;

/**
 * Barcodetypes
 */
class Barcodetypes
{
    /**
     * @var int
     */
    private $barcodetypesPk;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $defaultvalue;

    /**
     * @var string
     */
    private $datatype = 'int';

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string
     */
    private $maingroup = 'General';

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
     * Get barcodetypesPk.
     *
     * @return int
     */
    public function getBarcodetypesPk()
    {
        return $this->barcodetypesPk;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Barcodetypes
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
     * Set value.
     *
     * @param string $value
     *
     * @return Barcodetypes
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set defaultvalue.
     *
     * @param string $defaultvalue
     *
     * @return Barcodetypes
     */
    public function setDefaultvalue($defaultvalue)
    {
        $this->defaultvalue = $defaultvalue;

        return $this;
    }

    /**
     * Get defaultvalue.
     *
     * @return string
     */
    public function getDefaultvalue()
    {
        return $this->defaultvalue;
    }

    /**
     * Set datatype.
     *
     * @param string $datatype
     *
     * @return Barcodetypes
     */
    public function setDatatype($datatype)
    {
        $this->datatype = $datatype;

        return $this;
    }

    /**
     * Get datatype.
     *
     * @return string
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Barcodetypes
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
     * Set maingroup.
     *
     * @param string $maingroup
     *
     * @return Barcodetypes
     */
    public function setMaingroup($maingroup)
    {
        $this->maingroup = $maingroup;

        return $this;
    }

    /**
     * Get maingroup.
     *
     * @return string
     */
    public function getMaingroup()
    {
        return $this->maingroup;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Barcodetypes
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
     * @return Barcodetypes
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
     * @return Barcodetypes
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
     * @return Barcodetypes
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
     * @return Barcodetypes
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
