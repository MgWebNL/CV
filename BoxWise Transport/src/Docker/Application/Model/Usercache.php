<?php

namespace PenD\Docker\Application\Model;

/**
 * Usercache
 */
class Usercache
{
    /**
     * @var int
     */
    private $usercachePk;

    /**
     * @var int
     */
    private $userFk;

    /**
     * @var string
     */
    private $tags;

    /**
     * @var string|null
     */
    private $data;

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
     * Get usercachePk.
     *
     * @return int
     */
    public function getUsercachePk()
    {
        return $this->usercachePk;
    }

    /**
     * Set userFk.
     *
     * @param int $userFk
     *
     * @return Usercache
     */
    public function setUserFk($userFk)
    {
        $this->userFk = $userFk;

        return $this;
    }

    /**
     * Get userFk.
     *
     * @return int
     */
    public function getUserFk()
    {
        return $this->userFk;
    }

    /**
     * Set tags.
     *
     * @param string $tags
     *
     * @return Usercache
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags.
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set data.
     *
     * @param string|null $data
     *
     * @return Usercache
     */
    public function setData($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return string|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Usercache
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
     * @return Usercache
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
     * @return Usercache
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
     * @return Usercache
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
     * @return Usercache
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
