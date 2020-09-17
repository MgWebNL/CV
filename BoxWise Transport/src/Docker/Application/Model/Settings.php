<?php

namespace PenD\Docker\Application\Model;

/**
 * Settings
 */
class Settings
{
    /**
     * @var int
     */
    private $settingPk;

    /**
     * @var string
     */
    private $setting;

    /**
     * @var string|null
     */
    private $username;

    /**
     * @var string|null
     */
    private $machinename;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $valueasobject;

    /**
     * @var string
     */
    private $valueasstring = '';

    /**
     * @var int|null
     */
    private $valueasint32;

    /**
     * @var bool|null
     */
    private $valueasboolean;

    /**
     * @var bool
     */
    private $inherited = '0';

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
     * Get settingPk.
     *
     * @return int
     */
    public function getSettingPk()
    {
        return $this->settingPk;
    }

    /**
     * Set setting.
     *
     * @param string $setting
     *
     * @return Settings
     */
    public function setSetting($setting)
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * Get setting.
     *
     * @return string
     */
    public function getSetting()
    {
        return $this->setting;
    }

    /**
     * Set username.
     *
     * @param string|null $username
     *
     * @return Settings
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set machinename.
     *
     * @param string|null $machinename
     *
     * @return Settings
     */
    public function setMachinename($machinename = null)
    {
        $this->machinename = $machinename;

        return $this;
    }

    /**
     * Get machinename.
     *
     * @return string|null
     */
    public function getMachinename()
    {
        return $this->machinename;
    }

    /**
     * Set type.
     *
     * @param string $type
     *
     * @return Settings
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
     * Set valueasobject.
     *
     * @param string|null $valueasobject
     *
     * @return Settings
     */
    public function setValueasobject($valueasobject = null)
    {
        $this->valueasobject = $valueasobject;

        return $this;
    }

    /**
     * Get valueasobject.
     *
     * @return string|null
     */
    public function getValueasobject()
    {
        return $this->valueasobject;
    }

    /**
     * Set valueasstring.
     *
     * @param string $valueasstring
     *
     * @return Settings
     */
    public function setValueasstring($valueasstring)
    {
        $this->valueasstring = $valueasstring;

        return $this;
    }

    /**
     * Get valueasstring.
     *
     * @return string
     */
    public function getValueasstring()
    {
        return $this->valueasstring;
    }

    /**
     * Set valueasint32.
     *
     * @param int|null $valueasint32
     *
     * @return Settings
     */
    public function setValueasint32($valueasint32 = null)
    {
        $this->valueasint32 = $valueasint32;

        return $this;
    }

    /**
     * Get valueasint32.
     *
     * @return int|null
     */
    public function getValueasint32()
    {
        return $this->valueasint32;
    }

    /**
     * Set valueasboolean.
     *
     * @param bool|null $valueasboolean
     *
     * @return Settings
     */
    public function setValueasboolean($valueasboolean = null)
    {
        $this->valueasboolean = $valueasboolean;

        return $this;
    }

    /**
     * Get valueasboolean.
     *
     * @return bool|null
     */
    public function getValueasboolean()
    {
        return $this->valueasboolean;
    }

    /**
     * Set inherited.
     *
     * @param bool $inherited
     *
     * @return Settings
     */
    public function setInherited($inherited)
    {
        $this->inherited = $inherited;

        return $this;
    }

    /**
     * Get inherited.
     *
     * @return bool
     */
    public function getInherited()
    {
        return $this->inherited;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
     * @return Settings
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
