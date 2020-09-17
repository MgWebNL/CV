<?php

namespace PenD\Docker\Application\Model;

/**
 * Blobsmetadata
 */
class Blobsmetadata
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @var \PenD\Docker\Application\Model\Blobs
     */
    private $blobid;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Blobsmetadata
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
     * @param string|null $value
     *
     * @return Blobsmetadata
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
     * Set blobid.
     *
     * @param \PenD\Docker\Application\Model\Blobs|null $blobid
     *
     * @return Blobsmetadata
     */
    public function setBlobid(\PenD\Docker\Application\Model\Blobs $blobid = null)
    {
        $this->blobid = $blobid;

        return $this;
    }

    /**
     * Get blobid.
     *
     * @return \PenD\Docker\Application\Model\Blobs|null
     */
    public function getBlobid()
    {
        return $this->blobid;
    }
}
