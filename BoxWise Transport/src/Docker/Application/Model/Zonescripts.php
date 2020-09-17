<?php

namespace PenD\Docker\Application\Model;

/**
 * Zonescripts
 */
class Zonescripts
{
    /**
     * @var int
     */
    private $scriptPk;

    /**
     * @var string|null
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
     * @var bool
     */
    private $active = true;

    /**
     * @var string|null
     */
    private $hook;

    /**
     * @var int
     */
    private $hookversion = '1';

    /**
     * @var int
     */
    private $zonefk = '-1';

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
     * Get scriptPk.
     *
     * @return int
     */
    public function getScriptPk()
    {
        return $this->scriptPk;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Zonescripts
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
     * Set description.
     *
     * @param string|null $description
     *
     * @return Zonescripts
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
     * @return Zonescripts
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Zonescripts
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set hook.
     *
     * @param string|null $hook
     *
     * @return Zonescripts
     */
    public function setHook($hook = null)
    {
        $this->hook = $hook;

        return $this;
    }

    /**
     * Get hook.
     *
     * @return string|null
     */
    public function getHook()
    {
        return $this->hook;
    }

    /**
     * Set hookversion.
     *
     * @param int $hookversion
     *
     * @return Zonescripts
     */
    public function setHookversion($hookversion)
    {
        $this->hookversion = $hookversion;

        return $this;
    }

    /**
     * Get hookversion.
     *
     * @return int
     */
    public function getHookversion()
    {
        return $this->hookversion;
    }

    /**
     * Set zonefk.
     *
     * @param int $zonefk
     *
     * @return Zonescripts
     */
    public function setZonefk($zonefk)
    {
        $this->zonefk = $zonefk;

        return $this;
    }

    /**
     * Get zonefk.
     *
     * @return int
     */
    public function getZonefk()
    {
        return $this->zonefk;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Zonescripts
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
     * @return Zonescripts
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
     * @return Zonescripts
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
     * @return Zonescripts
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
     * @return Zonescripts
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
