<?php

namespace PenD\Docker\Application\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Shipments
 */
class Shipments
{
    /**
     * @var int
     */
    private $shipmentPk;

    /**
     * @var string|null
     */
    private $shipperid;

    /**
     * @var string
     */
    private $shipperserviceid;

    /**
     * @var string|null
     */
    private $shipperservicename;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $name2;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $address2;

    /**
     * @var string|null
     */
    private $address3;

    /**
     * @var string|null
     */
    private $zipcode;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $statecode;

    /**
     * @var string|null
     */
    private $countrycode;

    /**
     * @var string|null
     */
    private $countryname;

    /**
     * @var string|null
     */
    private $notes;

    /**
     * @var string|null
     */
    private $phonenumber;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var string|null
     */
    private $reference;

    /**
     * @var string|null
     */
    private $sendername;

    /**
     * @var string|null
     */
    private $sendername2;

    /**
     * @var string|null
     */
    private $senderaddress;

    /**
     * @var string|null
     */
    private $senderaddress2;

    /**
     * @var string|null
     */
    private $senderaddress3;

    /**
     * @var string|null
     */
    private $senderzipcode;

    /**
     * @var string|null
     */
    private $sendercity;

    /**
     * @var string|null
     */
    private $senderstatecode;

    /**
     * @var string|null
     */
    private $sendercountrycode;

    /**
     * @var string|null
     */
    private $sendercountryname;

    /**
     * @var string|null
     */
    private $senderphonenumber;

    /**
     * @var string|null
     */
    private $senderemail;

    /**
     * @var string|null
     */
    private $eorinumber;

    /**
     * @var string|null
     */
    private $customdata;

    /**
     * @var string|null
     */
    private $deliverynotepdf;

    /**
     * @var string|null
     */
    private $communicationartefacts;

    /**
     * @var bool
     */
    private $iscod = '0';

    /**
     * @var int
     */
    private $totalcharge = '0';

    /**
     * @var int
     */
    private $totalsalescharge = '0';

    /**
     * @var bool
     */
    private $canceled = '0';

    /**
     * @var \DateTime|null
     */
    private $pickupdatetime;

    /**
     * @var \DateTime|null
     */
    private $deliverybegindatetime;

    /**
     * @var \DateTime|null
     */
    private $deliveryenddatetime;

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
     * @var Collection|Shipmentpackages[]
     */
    private $shipmentpackages;

    /**
     * @param Collection|Shipmentpackages[] $shipmentpackages
     */
    public function setShipmentpackages($shipmentpackages): void
    {
        $this->shipmentpackages = $shipmentpackages;
    }

    /**
     * @return Collection|Shipmentpackages[]
     */
    public function getShipmentpackages()
    {
        return $this->shipmentpackages;
    }




    /**
     * Get shipmentPk.
     *
     * @return int
     */
    public function getShipmentPk()
    {
        return $this->shipmentPk;
    }

    /**
     * Set shipperid.
     *
     * @param string|null $shipperid
     *
     * @return Shipments
     */
    public function setShipperid($shipperid = null)
    {
        $this->shipperid = $shipperid;

        return $this;
    }

    /**
     * Get shipperid.
     *
     * @return string|null
     */
    public function getShipperid()
    {
        return $this->shipperid;
    }

    /**
     * Set shipperserviceid.
     *
     * @param string $shipperserviceid
     *
     * @return Shipments
     */
    public function setShipperserviceid($shipperserviceid)
    {
        $this->shipperserviceid = $shipperserviceid;

        return $this;
    }

    /**
     * Get shipperserviceid.
     *
     * @return string
     */
    public function getShipperserviceid()
    {
        return $this->shipperserviceid;
    }

    /**
     * Set shipperservicename.
     *
     * @param string|null $shipperservicename
     *
     * @return Shipments
     */
    public function setShipperservicename($shipperservicename = null)
    {
        $this->shipperservicename = $shipperservicename;

        return $this;
    }

    /**
     * Get shipperservicename.
     *
     * @return string|null
     */
    public function getShipperservicename()
    {
        return $this->shipperservicename;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Shipments
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
     * Set name2.
     *
     * @param string|null $name2
     *
     * @return Shipments
     */
    public function setName2($name2 = null)
    {
        $this->name2 = $name2;

        return $this;
    }

    /**
     * Get name2.
     *
     * @return string|null
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * Set address.
     *
     * @param string|null $address
     *
     * @return Shipments
     */
    public function setAddress($address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address.
     *
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address2.
     *
     * @param string|null $address2
     *
     * @return Shipments
     */
    public function setAddress2($address2 = null)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2.
     *
     * @return string|null
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address3.
     *
     * @param string|null $address3
     *
     * @return Shipments
     */
    public function setAddress3($address3 = null)
    {
        $this->address3 = $address3;

        return $this;
    }

    /**
     * Get address3.
     *
     * @return string|null
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Set zipcode.
     *
     * @param string|null $zipcode
     *
     * @return Shipments
     */
    public function setZipcode($zipcode = null)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode.
     *
     * @return string|null
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Shipments
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set statecode.
     *
     * @param string|null $statecode
     *
     * @return Shipments
     */
    public function setStatecode($statecode = null)
    {
        $this->statecode = $statecode;

        return $this;
    }

    /**
     * Get statecode.
     *
     * @return string|null
     */
    public function getStatecode()
    {
        return $this->statecode;
    }

    /**
     * Set countrycode.
     *
     * @param string|null $countrycode
     *
     * @return Shipments
     */
    public function setCountrycode($countrycode = null)
    {
        $this->countrycode = $countrycode;

        return $this;
    }

    /**
     * Get countrycode.
     *
     * @return string|null
     */
    public function getCountrycode()
    {
        return $this->countrycode;
    }

    /**
     * Set countryname.
     *
     * @param string|null $countryname
     *
     * @return Shipments
     */
    public function setCountryname($countryname = null)
    {
        $this->countryname = $countryname;

        return $this;
    }

    /**
     * Get countryname.
     *
     * @return string|null
     */
    public function getCountryname()
    {
        return $this->countryname;
    }

    /**
     * Set notes.
     *
     * @param string|null $notes
     *
     * @return Shipments
     */
    public function setNotes($notes = null)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes.
     *
     * @return string|null
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set phonenumber.
     *
     * @param string|null $phonenumber
     *
     * @return Shipments
     */
    public function setPhonenumber($phonenumber = null)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }

    /**
     * Get phonenumber.
     *
     * @return string|null
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Shipments
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set reference.
     *
     * @param string|null $reference
     *
     * @return Shipments
     */
    public function setReference($reference = null)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference.
     *
     * @return string|null
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set sendername.
     *
     * @param string|null $sendername
     *
     * @return Shipments
     */
    public function setSendername($sendername = null)
    {
        $this->sendername = $sendername;

        return $this;
    }

    /**
     * Get sendername.
     *
     * @return string|null
     */
    public function getSendername()
    {
        return $this->sendername;
    }

    /**
     * Set sendername2.
     *
     * @param string|null $sendername2
     *
     * @return Shipments
     */
    public function setSendername2($sendername2 = null)
    {
        $this->sendername2 = $sendername2;

        return $this;
    }

    /**
     * Get sendername2.
     *
     * @return string|null
     */
    public function getSendername2()
    {
        return $this->sendername2;
    }

    /**
     * Set senderaddress.
     *
     * @param string|null $senderaddress
     *
     * @return Shipments
     */
    public function setSenderaddress($senderaddress = null)
    {
        $this->senderaddress = $senderaddress;

        return $this;
    }

    /**
     * Get senderaddress.
     *
     * @return string|null
     */
    public function getSenderaddress()
    {
        return $this->senderaddress;
    }

    /**
     * Set senderaddress2.
     *
     * @param string|null $senderaddress2
     *
     * @return Shipments
     */
    public function setSenderaddress2($senderaddress2 = null)
    {
        $this->senderaddress2 = $senderaddress2;

        return $this;
    }

    /**
     * Get senderaddress2.
     *
     * @return string|null
     */
    public function getSenderaddress2()
    {
        return $this->senderaddress2;
    }

    /**
     * Set senderaddress3.
     *
     * @param string|null $senderaddress3
     *
     * @return Shipments
     */
    public function setSenderaddress3($senderaddress3 = null)
    {
        $this->senderaddress3 = $senderaddress3;

        return $this;
    }

    /**
     * Get senderaddress3.
     *
     * @return string|null
     */
    public function getSenderaddress3()
    {
        return $this->senderaddress3;
    }

    /**
     * Set senderzipcode.
     *
     * @param string|null $senderzipcode
     *
     * @return Shipments
     */
    public function setSenderzipcode($senderzipcode = null)
    {
        $this->senderzipcode = $senderzipcode;

        return $this;
    }

    /**
     * Get senderzipcode.
     *
     * @return string|null
     */
    public function getSenderzipcode()
    {
        return $this->senderzipcode;
    }

    /**
     * Set sendercity.
     *
     * @param string|null $sendercity
     *
     * @return Shipments
     */
    public function setSendercity($sendercity = null)
    {
        $this->sendercity = $sendercity;

        return $this;
    }

    /**
     * Get sendercity.
     *
     * @return string|null
     */
    public function getSendercity()
    {
        return $this->sendercity;
    }

    /**
     * Set senderstatecode.
     *
     * @param string|null $senderstatecode
     *
     * @return Shipments
     */
    public function setSenderstatecode($senderstatecode = null)
    {
        $this->senderstatecode = $senderstatecode;

        return $this;
    }

    /**
     * Get senderstatecode.
     *
     * @return string|null
     */
    public function getSenderstatecode()
    {
        return $this->senderstatecode;
    }

    /**
     * Set sendercountrycode.
     *
     * @param string|null $sendercountrycode
     *
     * @return Shipments
     */
    public function setSendercountrycode($sendercountrycode = null)
    {
        $this->sendercountrycode = $sendercountrycode;

        return $this;
    }

    /**
     * Get sendercountrycode.
     *
     * @return string|null
     */
    public function getSendercountrycode()
    {
        return $this->sendercountrycode;
    }

    /**
     * Set sendercountryname.
     *
     * @param string|null $sendercountryname
     *
     * @return Shipments
     */
    public function setSendercountryname($sendercountryname = null)
    {
        $this->sendercountryname = $sendercountryname;

        return $this;
    }

    /**
     * Get sendercountryname.
     *
     * @return string|null
     */
    public function getSendercountryname()
    {
        return $this->sendercountryname;
    }

    /**
     * Set senderphonenumber.
     *
     * @param string|null $senderphonenumber
     *
     * @return Shipments
     */
    public function setSenderphonenumber($senderphonenumber = null)
    {
        $this->senderphonenumber = $senderphonenumber;

        return $this;
    }

    /**
     * Get senderphonenumber.
     *
     * @return string|null
     */
    public function getSenderphonenumber()
    {
        return $this->senderphonenumber;
    }

    /**
     * Set senderemail.
     *
     * @param string|null $senderemail
     *
     * @return Shipments
     */
    public function setSenderemail($senderemail = null)
    {
        $this->senderemail = $senderemail;

        return $this;
    }

    /**
     * Get senderemail.
     *
     * @return string|null
     */
    public function getSenderemail()
    {
        return $this->senderemail;
    }

    /**
     * Set eorinumber.
     *
     * @param string|null $eorinumber
     *
     * @return Shipments
     */
    public function setEorinumber($eorinumber = null)
    {
        $this->eorinumber = $eorinumber;

        return $this;
    }

    /**
     * Get eorinumber.
     *
     * @return string|null
     */
    public function getEorinumber()
    {
        return $this->eorinumber;
    }

    /**
     * Set customdata.
     *
     * @param string|null $customdata
     *
     * @return Shipments
     */
    public function setCustomdata($customdata = null)
    {
        $this->customdata = $customdata;

        return $this;
    }

    /**
     * Get customdata.
     *
     * @return string|null
     */
    public function getCustomdata()
    {
        return $this->customdata;
    }

    /**
     * Set deliverynotepdf.
     *
     * @param string|null $deliverynotepdf
     *
     * @return Shipments
     */
    public function setDeliverynotepdf($deliverynotepdf = null)
    {
        $this->deliverynotepdf = $deliverynotepdf;

        return $this;
    }

    /**
     * Get deliverynotepdf.
     *
     * @return string|null
     */
    public function getDeliverynotepdf()
    {
        return $this->deliverynotepdf;
    }

    /**
     * Set communicationartefacts.
     *
     * @param string|null $communicationartefacts
     *
     * @return Shipments
     */
    public function setCommunicationartefacts($communicationartefacts = null)
    {
        $this->communicationartefacts = $communicationartefacts;

        return $this;
    }

    /**
     * Get communicationartefacts.
     *
     * @return string|null
     */
    public function getCommunicationartefacts()
    {
        return $this->communicationartefacts;
    }

    /**
     * Set iscod.
     *
     * @param bool $iscod
     *
     * @return Shipments
     */
    public function setIscod($iscod)
    {
        $this->iscod = $iscod;

        return $this;
    }

    /**
     * Get iscod.
     *
     * @return bool
     */
    public function getIscod()
    {
        return $this->iscod;
    }

    /**
     * Set totalcharge.
     *
     * @param int $totalcharge
     *
     * @return Shipments
     */
    public function setTotalcharge($totalcharge)
    {
        $this->totalcharge = $totalcharge;

        return $this;
    }

    /**
     * Get totalcharge.
     *
     * @return int
     */
    public function getTotalcharge()
    {
        return $this->totalcharge;
    }

    /**
     * Set totalsalescharge.
     *
     * @param int $totalsalescharge
     *
     * @return Shipments
     */
    public function setTotalsalescharge($totalsalescharge)
    {
        $this->totalsalescharge = $totalsalescharge;

        return $this;
    }

    /**
     * Get totalsalescharge.
     *
     * @return int
     */
    public function getTotalsalescharge()
    {
        return $this->totalsalescharge;
    }

    /**
     * Set canceled.
     *
     * @param bool $canceled
     *
     * @return Shipments
     */
    public function setCanceled($canceled)
    {
        $this->canceled = $canceled;

        return $this;
    }

    /**
     * Get canceled.
     *
     * @return bool
     */
    public function getCanceled()
    {
        return $this->canceled;
    }

    /**
     * Set pickupdatetime.
     *
     * @param \DateTime|null $pickupdatetime
     *
     * @return Shipments
     */
    public function setPickupdatetime($pickupdatetime = null)
    {
        $this->pickupdatetime = $pickupdatetime;

        return $this;
    }

    /**
     * Get pickupdatetime.
     *
     * @return \DateTime|null
     */
    public function getPickupdatetime()
    {
        return $this->pickupdatetime;
    }

    /**
     * Set deliverybegindatetime.
     *
     * @param \DateTime|null $deliverybegindatetime
     *
     * @return Shipments
     */
    public function setDeliverybegindatetime($deliverybegindatetime = null)
    {
        $this->deliverybegindatetime = $deliverybegindatetime;

        return $this;
    }

    /**
     * Get deliverybegindatetime.
     *
     * @return \DateTime|null
     */
    public function getDeliverybegindatetime()
    {
        return $this->deliverybegindatetime;
    }

    /**
     * Set deliveryenddatetime.
     *
     * @param \DateTime|null $deliveryenddatetime
     *
     * @return Shipments
     */
    public function setDeliveryenddatetime($deliveryenddatetime = null)
    {
        $this->deliveryenddatetime = $deliveryenddatetime;

        return $this;
    }

    /**
     * Get deliveryenddatetime.
     *
     * @return \DateTime|null
     */
    public function getDeliveryenddatetime()
    {
        return $this->deliveryenddatetime;
    }

    /**
     * Set createdon.
     *
     * @param \DateTime $createdon
     *
     * @return Shipments
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
     * @return Shipments
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
     * @return Shipments
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
     * @return Shipments
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
     * @return Shipments
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
