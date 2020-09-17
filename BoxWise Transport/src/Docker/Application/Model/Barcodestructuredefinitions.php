<?php

namespace PenD\Docker\Application\Model;

/**
 * Barcodestructuredefinitions
 */
class Barcodestructuredefinitions
{
    /**
     * @var int
     */
    private $barcodestructuredefinitionsPk;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $regularexpression;

    /**
     * @var string
     */
    private $parseinstructions;

    /**
     * @var string
     */
    private $replaceinstructions = '';

    /**
     * @var int
     */
    private $priority = '99';

    /**
     * @var bool
     */
    private $active = true;

    /**
     * @var bool
     */
    private $usescript = '0';

    /**
     * @var string|null
     */
    private $script;

    /**
     * @var bool
     */
    private $system = '0';

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
     * Get barcodestructuredefinitionsPk.
     *
     * @return int
     */
    public function getBarcodestructuredefinitionsPk()
    {
        return $this->barcodestructuredefinitionsPk;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Barcodestructuredefinitions
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
     * Set regularexpression.
     *
     * @param string $regularexpression
     *
     * @return Barcodestructuredefinitions
     */
    public function setRegularexpression($regularexpression)
    {
        $this->regularexpression = $regularexpression;

        return $this;
    }

    /**
     * Get regularexpression.
     *
     * @return string
     */
    public function getRegularexpression()
    {
        return $this->regularexpression;
    }

    /**
     * Set parseinstructions.
     *
     * @param string $parseinstructions
     *
     * @return Barcodestructuredefinitions
     */
    public function setParseinstructions($parseinstructions)
    {
        $this->parseinstructions = $parseinstructions;

        return $this;
    }

    /**
     * Get parseinstructions.
     *
     * @return string
     */
    public function getParseinstructions()
    {
        return $this->parseinstructions;
    }

    /**
     * Set replaceinstructions.
     *
     * @param string $replaceinstructions
     *
     * @return Barcodestructuredefinitions
     */
    public function setReplaceinstructions($replaceinstructions)
    {
        $this->replaceinstructions = $replaceinstructions;

        return $this;
    }

    /**
     * Get replaceinstructions.
     *
     * @return string
     */
    public function getReplaceinstructions()
    {
        return $this->replaceinstructions;
    }

    /**
     * Set priority.
     *
     * @param int $priority
     *
     * @return Barcodestructuredefinitions
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Barcodestructuredefinitions
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
     * Set usescript.
     *
     * @param bool $usescript
     *
     * @return Barcodestructuredefinitions
     */
    public function setUsescript($usescript)
    {
        $this->usescript = $usescript;

        return $this;
    }

    /**
     * Get usescript.
     *
     * @return bool
     */
    public function getUsescript()
    {
        return $this->usescript;
    }

    /**
     * Set script.
     *
     * @param string|null $script
     *
     * @return Barcodestructuredefinitions
     */
    public function setScript($script = null)
    {
        $this->script = $script;

        return $this;
    }

    /**
     * Get script.
     *
     * @return string|null
     */
    public function getScript()
    {
        return $this->script;
    }

    /**
     * Set system.
     *
     * @param bool $system
     *
     * @return Barcodestructuredefinitions
     */
    public function setSystem($system)
    {
        $this->system = $system;

        return $this;
    }

    /**
     * Get system.
     *
     * @return bool
     */
    public function getSystem()
    {
        return $this->system;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Barcodestructuredefinitions
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
     * @return Barcodestructuredefinitions
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
     * @return Barcodestructuredefinitions
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
     * @return Barcodestructuredefinitions
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
     * @return Barcodestructuredefinitions
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
