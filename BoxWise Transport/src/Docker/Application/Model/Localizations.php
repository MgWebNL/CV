<?php

namespace PenD\Docker\Application\Model;

/**
 * Localizations
 */
class Localizations
{
    /**
     * @var int
     */
    private $pk;

    /**
     * @var string|null
     */
    private $resourceid;

    /**
     * @var string|null
     */
    private $value = '';

    /**
     * @var string|null
     */
    private $localeid = '';

    /**
     * @var string|null
     */
    private $resourceset = '';

    /**
     * @var string|null
     */
    private $type = '';

    /**
     * @var binary|null
     */
    private $binfile;

    /**
     * @var string|null
     */
    private $textfile;

    /**
     * @var string|null
     */
    private $filename = '';

    /**
     * @var string|null
     */
    private $comment;

    /**
     * @var int
     */
    private $valuetype = '0';

    /**
     * @var \DateTime|null
     */
    private $updated = 'getutcdate()';


    /**
     * Get pk.
     *
     * @return int
     */
    public function getPk()
    {
        return $this->pk;
    }

    /**
     * Set resourceid.
     *
     * @param string|null $resourceid
     *
     * @return Localizations
     */
    public function setResourceid($resourceid = null)
    {
        $this->resourceid = $resourceid;

        return $this;
    }

    /**
     * Get resourceid.
     *
     * @return string|null
     */
    public function getResourceid()
    {
        return $this->resourceid;
    }

    /**
     * Set value.
     *
     * @param string|null $value
     *
     * @return Localizations
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
     * Set localeid.
     *
     * @param string|null $localeid
     *
     * @return Localizations
     */
    public function setLocaleid($localeid = null)
    {
        $this->localeid = $localeid;

        return $this;
    }

    /**
     * Get localeid.
     *
     * @return string|null
     */
    public function getLocaleid()
    {
        return $this->localeid;
    }

    /**
     * Set resourceset.
     *
     * @param string|null $resourceset
     *
     * @return Localizations
     */
    public function setResourceset($resourceset = null)
    {
        $this->resourceset = $resourceset;

        return $this;
    }

    /**
     * Get resourceset.
     *
     * @return string|null
     */
    public function getResourceset()
    {
        return $this->resourceset;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return Localizations
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set binfile.
     *
     * @param binary|null $binfile
     *
     * @return Localizations
     */
    public function setBinfile($binfile = null)
    {
        $this->binfile = $binfile;

        return $this;
    }

    /**
     * Get binfile.
     *
     * @return binary|null
     */
    public function getBinfile()
    {
        return $this->binfile;
    }

    /**
     * Set textfile.
     *
     * @param string|null $textfile
     *
     * @return Localizations
     */
    public function setTextfile($textfile = null)
    {
        $this->textfile = $textfile;

        return $this;
    }

    /**
     * Get textfile.
     *
     * @return string|null
     */
    public function getTextfile()
    {
        return $this->textfile;
    }

    /**
     * Set filename.
     *
     * @param string|null $filename
     *
     * @return Localizations
     */
    public function setFilename($filename = null)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename.
     *
     * @return string|null
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return Localizations
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set valuetype.
     *
     * @param int $valuetype
     *
     * @return Localizations
     */
    public function setValuetype($valuetype)
    {
        $this->valuetype = $valuetype;

        return $this;
    }

    /**
     * Get valuetype.
     *
     * @return int
     */
    public function getValuetype()
    {
        return $this->valuetype;
    }

    /**
     * Set updated.
     *
     * @param \DateTime|null $updated
     *
     * @return Localizations
     */
    public function setUpdated($updated = null)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime|null
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
