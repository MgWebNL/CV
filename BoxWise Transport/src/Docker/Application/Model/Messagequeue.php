<?php

namespace PenD\Docker\Application\Model;

/**
 * Messagequeue
 */
class Messagequeue
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $parentid;

    /**
     * @var string|null
     */
    private $referenceid;

    /**
     * @var bool
     */
    private $hasstockallocations = '0';

    /**
     * @var string
     */
    private $type;

    /**
     * @var binary|null
     */
    private $body;

    /**
     * @var string|null
     */
    private $bodymimetype;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var string|null
     */
    private $source;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $priority = '3';

    /**
     * @var string|null
     */
    private $log;

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
    private $bodysize;


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
     * Set parentid.
     *
     * @param string|null $parentid
     *
     * @return Messagequeue
     */
    public function setParentid($parentid = null)
    {
        $this->parentid = $parentid;

        return $this;
    }

    /**
     * Get parentid.
     *
     * @return string|null
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set referenceid.
     *
     * @param string|null $referenceid
     *
     * @return Messagequeue
     */
    public function setReferenceid($referenceid = null)
    {
        $this->referenceid = $referenceid;

        return $this;
    }

    /**
     * Get referenceid.
     *
     * @return string|null
     */
    public function getReferenceid()
    {
        return $this->referenceid;
    }

    /**
     * Set hasstockallocations.
     *
     * @param bool $hasstockallocations
     *
     * @return Messagequeue
     */
    public function setHasstockallocations($hasstockallocations)
    {
        $this->hasstockallocations = $hasstockallocations;

        return $this;
    }

    /**
     * Get hasstockallocations.
     *
     * @return bool
     */
    public function getHasstockallocations()
    {
        return $this->hasstockallocations;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Messagequeue
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
     * Set body.
     *
     * @param binary|null $body
     *
     * @return Messagequeue
     */
    public function setBody($body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return binary|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set bodymimetype.
     *
     * @param string|null $bodymimetype
     *
     * @return Messagequeue
     */
    public function setBodymimetype($bodymimetype = null)
    {
        $this->bodymimetype = $bodymimetype;

        return $this;
    }

    /**
     * Get bodymimetype.
     *
     * @return string|null
     */
    public function getBodymimetype()
    {
        return $this->bodymimetype;
    }

    /**
     * Set label.
     *
     * @param string|null $label
     *
     * @return Messagequeue
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
     * Set source.
     *
     * @param string|null $source
     *
     * @return Messagequeue
     */
    public function setSource($source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source.
     *
     * @return string|null
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return Messagequeue
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
     * Set priority.
     *
     * @param int $priority
     *
     * @return Messagequeue
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority.
     *
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set log.
     *
     * @param string|null $log
     *
     * @return Messagequeue
     */
    public function setLog($log = null)
    {
        $this->log = $log;

        return $this;
    }

    /**
     * Get log.
     *
     * @return string|null
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Messagequeue
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
     * @return Messagequeue
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
     * @return Messagequeue
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
     * @return Messagequeue
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
     * @return Messagequeue
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
     * Set bodysize.
     *
     * @param int|null $bodysize
     *
     * @return Messagequeue
     */
    public function setBodysize($bodysize = null)
    {
        $this->bodysize = $bodysize;

        return $this;
    }

    /**
     * Get bodysize.
     *
     * @return int|null
     */
    public function getBodysize()
    {
        return $this->bodysize;
    }
}
