<?php

namespace PenD\Docker\Application\Model;

/**
 * Countries
 */
class Countries
{
    /**
     * @var int
     */
    private $countryPk;

    /**
     * @var string|null
     */
    private $code;

    /**
     * @var string
     */
    private $isocode;

    /**
     * @var string
     */
    private $isonr;

    /**
     * @var string
     */
    private $isocurrencycode;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $membereu;

    /**
     * @var string
     */
    private $region;

    /**
     * @var bool
     */
    private $vatduty;

    /**
     * @var int
     */
    private $exchangerate;

    /**
     * @var bool
     */
    private $active;

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
     * Get countryPk.
     *
     * @return int
     */
    public function getCountryPk()
    {
        return $this->countryPk;
    }

    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return Countries
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set isocode.
     *
     * @param string $isocode
     *
     * @return Countries
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;

        return $this;
    }

    /**
     * Get isocode.
     *
     * @return string
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * Set isonr.
     *
     * @param string $isonr
     *
     * @return Countries
     */
    public function setIsonr($isonr)
    {
        $this->isonr = $isonr;

        return $this;
    }

    /**
     * Get isonr.
     *
     * @return string
     */
    public function getIsonr()
    {
        return $this->isonr;
    }

    /**
     * Set isocurrencycode.
     *
     * @param string $isocurrencycode
     *
     * @return Countries
     */
    public function setIsocurrencycode($isocurrencycode)
    {
        $this->isocurrencycode = $isocurrencycode;

        return $this;
    }

    /**
     * Get isocurrencycode.
     *
     * @return string
     */
    public function getIsocurrencycode()
    {
        return $this->isocurrencycode;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Countries
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
     * Set membereu.
     *
     * @param bool $membereu
     *
     * @return Countries
     */
    public function setMembereu($membereu)
    {
        $this->membereu = $membereu;

        return $this;
    }

    /**
     * Get membereu.
     *
     * @return bool
     */
    public function getMembereu()
    {
        return $this->membereu;
    }

    /**
     * Set region.
     *
     * @param string $region
     *
     * @return Countries
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set vatduty.
     *
     * @param bool $vatduty
     *
     * @return Countries
     */
    public function setVatduty($vatduty)
    {
        $this->vatduty = $vatduty;

        return $this;
    }

    /**
     * Get vatduty.
     *
     * @return bool
     */
    public function getVatduty()
    {
        return $this->vatduty;
    }

    /**
     * Set exchangerate.
     *
     * @param int $exchangerate
     *
     * @return Countries
     */
    public function setExchangerate($exchangerate)
    {
        $this->exchangerate = $exchangerate;

        return $this;
    }

    /**
     * Get exchangerate.
     *
     * @return int
     */
    public function getExchangerate()
    {
        return $this->exchangerate;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Countries
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
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Countries
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
     * @return Countries
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
     * @return Countries
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
     * @return Countries
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
     * @return Countries
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
