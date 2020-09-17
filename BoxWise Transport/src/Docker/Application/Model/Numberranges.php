<?php

namespace PenD\Docker\Application\Model;

/**
 * Numberranges
 */
class Numberranges
{
    /**
     * @var int
     */
    private $numberrangePk;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $from;

    /**
     * @var int
     */
    private $to;

    /**
     * @var int
     */
    private $current;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $prefix;

    /**
     * @var string|null
     */
    private $suffix;

    /**
     * @var int|null
     */
    private $length;

    /**
     * @var \DateTime|null
     */
    private $reseton;

    /**
     * @var string|null
     */
    private $resetby;

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
     * Get numberrangePk.
     *
     * @return int
     */
    public function getNumberrangePk()
    {
        return $this->numberrangePk;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Numberranges
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
     * Set from.
     *
     * @param int $from
     *
     * @return Numberranges
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from.
     *
     * @return int
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to.
     *
     * @param int $to
     *
     * @return Numberranges
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to.
     *
     * @return int
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set current.
     *
     * @param int $current
     *
     * @return Numberranges
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current.
     *
     * @return int
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Numberranges
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set prefix.
     *
     * @param string|null $prefix
     *
     * @return Numberranges
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix.
     *
     * @return string|null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set suffix.
     *
     * @param string|null $suffix
     *
     * @return Numberranges
     */
    public function setSuffix($suffix = null)
    {
        $this->suffix = $suffix;

        return $this;
    }

    /**
     * Get suffix.
     *
     * @return string|null
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Set length.
     *
     * @param int|null $length
     *
     * @return Numberranges
     */
    public function setLength($length = null)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length.
     *
     * @return int|null
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set reseton.
     *
     * @param \DateTime|null $reseton
     *
     * @return Numberranges
     */
    public function setReseton($reseton = null)
    {
        $this->reseton = $reseton;

        return $this;
    }

    /**
     * Get reseton.
     *
     * @return \DateTime|null
     */
    public function getReseton()
    {
        return $this->reseton;
    }

    /**
     * Set resetby.
     *
     * @param string|null $resetby
     *
     * @return Numberranges
     */
    public function setResetby($resetby = null)
    {
        $this->resetby = $resetby;

        return $this;
    }

    /**
     * Get resetby.
     *
     * @return string|null
     */
    public function getResetby()
    {
        return $this->resetby;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Numberranges
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
     * @return Numberranges
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
     * @return Numberranges
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
     * @return Numberranges
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
     * @return Numberranges
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
