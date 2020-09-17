<?php

namespace PenD\Docker\Application\Model;

/**
 * Locationclassifications
 */
class Locationclassifications
{
    /**
     * @var int
     */
    private $locationclassificationPk;

    /**
     * @var int
     */
    private $storageassignmentclassificationFk;

    /**
     * @var string|null
     */
    private $blockfrom;

    /**
     * @var string|null
     */
    private $blockto;

    /**
     * @var string|null
     */
    private $aislefrom;

    /**
     * @var string|null
     */
    private $aisleto;

    /**
     * @var string|null
     */
    private $columnfrom;

    /**
     * @var string|null
     */
    private $columnto;

    /**
     * @var string|null
     */
    private $shelvefrom;

    /**
     * @var string|null
     */
    private $shelveto;

    /**
     * @var bool
     */
    private $usescript = '0';

    /**
     * @var string|null
     */
    private $script;

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
     * @var \PenD\Docker\Application\Model\Warehouselayoutsettings
     */
    private $warehouselayoutsettingsFk;


    /**
     * Get locationclassificationPk.
     *
     * @return int
     */
    public function getLocationclassificationPk()
    {
        return $this->locationclassificationPk;
    }

    /**
     * Set storageassignmentclassificationFk.
     *
     * @param int $storageassignmentclassificationFk
     *
     * @return Locationclassifications
     */
    public function setStorageassignmentclassificationFk($storageassignmentclassificationFk)
    {
        $this->storageassignmentclassificationFk = $storageassignmentclassificationFk;

        return $this;
    }

    /**
     * Get storageassignmentclassificationFk.
     *
     * @return int
     */
    public function getStorageassignmentclassificationFk()
    {
        return $this->storageassignmentclassificationFk;
    }

    /**
     * Set blockfrom.
     *
     * @param string|null $blockfrom
     *
     * @return Locationclassifications
     */
    public function setBlockfrom($blockfrom = null)
    {
        $this->blockfrom = $blockfrom;

        return $this;
    }

    /**
     * Get blockfrom.
     *
     * @return string|null
     */
    public function getBlockfrom()
    {
        return $this->blockfrom;
    }

    /**
     * Set blockto.
     *
     * @param string|null $blockto
     *
     * @return Locationclassifications
     */
    public function setBlockto($blockto = null)
    {
        $this->blockto = $blockto;

        return $this;
    }

    /**
     * Get blockto.
     *
     * @return string|null
     */
    public function getBlockto()
    {
        return $this->blockto;
    }

    /**
     * Set aislefrom.
     *
     * @param string|null $aislefrom
     *
     * @return Locationclassifications
     */
    public function setAislefrom($aislefrom = null)
    {
        $this->aislefrom = $aislefrom;

        return $this;
    }

    /**
     * Get aislefrom.
     *
     * @return string|null
     */
    public function getAislefrom()
    {
        return $this->aislefrom;
    }

    /**
     * Set aisleto.
     *
     * @param string|null $aisleto
     *
     * @return Locationclassifications
     */
    public function setAisleto($aisleto = null)
    {
        $this->aisleto = $aisleto;

        return $this;
    }

    /**
     * Get aisleto.
     *
     * @return string|null
     */
    public function getAisleto()
    {
        return $this->aisleto;
    }

    /**
     * Set columnfrom.
     *
     * @param string|null $columnfrom
     *
     * @return Locationclassifications
     */
    public function setColumnfrom($columnfrom = null)
    {
        $this->columnfrom = $columnfrom;

        return $this;
    }

    /**
     * Get columnfrom.
     *
     * @return string|null
     */
    public function getColumnfrom()
    {
        return $this->columnfrom;
    }

    /**
     * Set columnto.
     *
     * @param string|null $columnto
     *
     * @return Locationclassifications
     */
    public function setColumnto($columnto = null)
    {
        $this->columnto = $columnto;

        return $this;
    }

    /**
     * Get columnto.
     *
     * @return string|null
     */
    public function getColumnto()
    {
        return $this->columnto;
    }

    /**
     * Set shelvefrom.
     *
     * @param string|null $shelvefrom
     *
     * @return Locationclassifications
     */
    public function setShelvefrom($shelvefrom = null)
    {
        $this->shelvefrom = $shelvefrom;

        return $this;
    }

    /**
     * Get shelvefrom.
     *
     * @return string|null
     */
    public function getShelvefrom()
    {
        return $this->shelvefrom;
    }

    /**
     * Set shelveto.
     *
     * @param string|null $shelveto
     *
     * @return Locationclassifications
     */
    public function setShelveto($shelveto = null)
    {
        $this->shelveto = $shelveto;

        return $this;
    }

    /**
     * Get shelveto.
     *
     * @return string|null
     */
    public function getShelveto()
    {
        return $this->shelveto;
    }

    /**
     * Set usescript.
     *
     * @param bool $usescript
     *
     * @return Locationclassifications
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
     * @return Locationclassifications
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Locationclassifications
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
     * @return Locationclassifications
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
     * @return Locationclassifications
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
     * @return Locationclassifications
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
     * @return Locationclassifications
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
     * Set warehouselayoutsettingsFk.
     *
     * @param \PenD\Docker\Application\Model\Warehouselayoutsettings|null $warehouselayoutsettingsFk
     *
     * @return Locationclassifications
     */
    public function setWarehouselayoutsettingsFk(\PenD\Docker\Application\Model\Warehouselayoutsettings $warehouselayoutsettingsFk = null)
    {
        $this->warehouselayoutsettingsFk = $warehouselayoutsettingsFk;

        return $this;
    }

    /**
     * Get warehouselayoutsettingsFk.
     *
     * @return \PenD\Docker\Application\Model\Warehouselayoutsettings|null
     */
    public function getWarehouselayoutsettingsFk()
    {
        return $this->warehouselayoutsettingsFk;
    }
}
