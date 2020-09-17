<?php

namespace PenD\Docker\Application\Model;

/**
 * Genericsync
 */
class Genericsync
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $jsondata;

    /**
     * @var int
     */
    private $hash;


    /**
     * Set key.
     *
     * @param string $key
     *
     * @return Genericsync
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Genericsync
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
     * Set jsondata.
     *
     * @param string $jsondata
     *
     * @return Genericsync
     */
    public function setJsondata($jsondata)
    {
        $this->jsondata = $jsondata;

        return $this;
    }

    /**
     * Get jsondata.
     *
     * @return string
     */
    public function getJsondata()
    {
        return $this->jsondata;
    }

    /**
     * Set hash.
     *
     * @param int $hash
     *
     * @return Genericsync
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash.
     *
     * @return int
     */
    public function getHash()
    {
        return $this->hash;
    }
}
