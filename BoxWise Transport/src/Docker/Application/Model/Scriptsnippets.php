<?php

namespace PenD\Docker\Application\Model;

/**
 * Scriptsnippets
 */
class Scriptsnippets
{
    /**
     * @var int
     */
    private $scriptsnippetPk;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string
     */
    private $script;

    /**
     * @var \DateTime
     */
    private $createdon;

    /**
     * @var string
     */
    private $createdby;

    /**
     * @var \DateTime
     */
    private $modifiedon;

    /**
     * @var string
     */
    private $modifiedby;

    /**
     * @var string
     */
    private $rowversion;

    /**
     * @var \PenD\Docker\Application\Model\Users
     */
    private $userFk;


    /**
     * Get scriptsnippetPk.
     *
     * @return int
     */
    public function getScriptsnippetPk()
    {
        return $this->scriptsnippetPk;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Scriptsnippets
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
     * @return Scriptsnippets
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
     * Set script.
     *
     * @param string $script
     *
     * @return Scriptsnippets
     */
    public function setScript($script)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script.
     *
     * @return string
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Scriptsnippets
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
     * @return Scriptsnippets
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
     * @return Scriptsnippets
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
     * @return Scriptsnippets
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
     * @return Scriptsnippets
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
     * Set userFk.
     *
     * @param \PenD\Docker\Application\Model\Users|null $userFk
     *
     * @return Scriptsnippets
     */
    public function setUserFk(\PenD\Docker\Application\Model\Users $userFk = null)
    {
        $this->userFk = $userFk;

        return $this;
    }

    /**
     * Get userFk.
     *
     * @return \PenD\Docker\Application\Model\Users|null
     */
    public function getUserFk()
    {
        return $this->userFk;
    }
}
