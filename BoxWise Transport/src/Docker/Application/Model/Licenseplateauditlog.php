<?php

namespace PenD\Docker\Application\Model;

/**
 * Licenseplateauditlog
 */
class Licenseplateauditlog
{
    /**
     * @var int
     */
    private $licenseplateauditlogPk;

    /**
     * @var string
     */
    private $oldstatus;

    /**
     * @var string
     */
    private $newstatus;

    /**
     * @var string|null
     */
    private $description;

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
     * @var \PenD\Docker\Application\Model\Licenseplates
     */
    private $licenseplateFk;


    /**
     * Get licenseplateauditlogPk.
     *
     * @return int
     */
    public function getLicenseplateauditlogPk()
    {
        return $this->licenseplateauditlogPk;
    }

    /**
     * Set oldstatus.
     *
     * @param string $oldstatus
     *
     * @return Licenseplateauditlog
     */
    public function setOldstatus($oldstatus)
    {
        $this->oldstatus = $oldstatus;

        return $this;
    }

    /**
     * Get oldstatus.
     *
     * @return string
     */
    public function getOldstatus()
    {
        return $this->oldstatus;
    }

    /**
     * Set newstatus.
     *
     * @param string $newstatus
     *
     * @return Licenseplateauditlog
     */
    public function setNewstatus($newstatus)
    {
        $this->newstatus = $newstatus;

        return $this;
    }

    /**
     * Get newstatus.
     *
     * @return string
     */
    public function getNewstatus()
    {
        return $this->newstatus;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Licenseplateauditlog
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Licenseplateauditlog
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
     * @return Licenseplateauditlog
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
     * @return Licenseplateauditlog
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
     * @return Licenseplateauditlog
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
     * @return Licenseplateauditlog
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
     * Set licenseplateFk.
     *
     * @param \PenD\Docker\Application\Model\Licenseplates|null $licenseplateFk
     *
     * @return Licenseplateauditlog
     */
    public function setLicenseplateFk(\PenD\Docker\Application\Model\Licenseplates $licenseplateFk = null)
    {
        $this->licenseplateFk = $licenseplateFk;

        return $this;
    }

    /**
     * Get licenseplateFk.
     *
     * @return \PenD\Docker\Application\Model\Licenseplates|null
     */
    public function getLicenseplateFk()
    {
        return $this->licenseplateFk;
    }
}
