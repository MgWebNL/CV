<?php

namespace PenD\Docker\Application\Model;

/**
 * Backgroundagents
 */
class Backgroundagents
{
    /**
     * @var int
     */
    private $backgroundagentsPk;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $os;

    /**
     * @var bool
     */
    private $isauthorized = '0';

    /**
     * @var \DateTime
     */
    private $lastseen = 'getutcdate()';

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
     * Get backgroundagentsPk.
     *
     * @return int
     */
    public function getBackgroundagentsPk()
    {
        return $this->backgroundagentsPk;
    }

    /**
     * Set id.
     *
     * @param string $id
     *
     * @return Backgroundagents
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Set name.
     *
     * @param string|null $name
     *
     * @return Backgroundagents
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Backgroundagents
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
     * Set os.
     *
     * @param string|null $os
     *
     * @return Backgroundagents
     */
    public function setOs($os = null)
    {
        $this->os = $os;

        return $this;
    }

    /**
     * Get os.
     *
     * @return string|null
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set isauthorized.
     *
     * @param bool $isauthorized
     *
     * @return Backgroundagents
     */
    public function setIsauthorized($isauthorized)
    {
        $this->isauthorized = $isauthorized;

        return $this;
    }

    /**
     * Get isauthorized.
     *
     * @return bool
     */
    public function getIsauthorized()
    {
        return $this->isauthorized;
    }

    /**
     * Set lastseen.
     *
     * @param \DateTime $lastseen
     *
     * @return Backgroundagents
     */
    public function setLastseen($lastseen)
    {
        $this->lastseen = $lastseen;

        return $this;
    }

    /**
     * Get lastseen.
     *
     * @return \DateTime
     */
    public function getLastseen()
    {
        return $this->lastseen;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Backgroundagents
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
     * @return Backgroundagents
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
     * @return Backgroundagents
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
     * @return Backgroundagents
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
     * @return Backgroundagents
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
