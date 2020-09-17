<?php

namespace PenD\Docker\Application\Model;

/**
 * Printrulelines
 */
class Printrulelines
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $attributename;

    /**
     * @var string
     */
    private $operator;

    /**
     * @var string|null
     */
    private $value;

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
     * @var \PenD\Docker\Application\Model\Printrules
     */
    private $printruleid;


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
     * Set attributename.
     *
     * @param string $attributename
     *
     * @return Printrulelines
     */
    public function setAttributename($attributename)
    {
        $this->attributename = $attributename;

        return $this;
    }

    /**
     * Get attributename.
     *
     * @return string
     */
    public function getAttributename()
    {
        return $this->attributename;
    }

    /**
     * Set operator.
     *
     * @param string $operator
     *
     * @return Printrulelines
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
     * Get operator.
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Set value.
     *
     * @param string|null $value
     *
     * @return Printrulelines
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return string|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Printrulelines
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
     * @return Printrulelines
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
     * @return Printrulelines
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
     * @return Printrulelines
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
     * @return Printrulelines
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
     * Set printruleid.
     *
     * @param \PenD\Docker\Application\Model\Printrules|null $printruleid
     *
     * @return Printrulelines
     */
    public function setPrintruleid(\PenD\Docker\Application\Model\Printrules $printruleid = null)
    {
        $this->printruleid = $printruleid;

        return $this;
    }

    /**
     * Get printruleid.
     *
     * @return \PenD\Docker\Application\Model\Printrules|null
     */
    public function getPrintruleid()
    {
        return $this->printruleid;
    }
}
