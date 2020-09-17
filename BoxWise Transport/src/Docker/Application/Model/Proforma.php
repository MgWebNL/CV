<?php

namespace PenD\Docker\Application\Model;

/**
 * Proforma
 */
class Proforma
{
    /**
     * @var int
     */
    private $proformaPk;

    /**
     * @var int
     */
    private $shipmentpackageitemsFk;

    /**
     * @var int
     */
    private $number;

    /**
     * @var int
     */
    private $linenumber;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string|null
     */
    private $freightcharges;

    /**
     * @var string|null
     */
    private $insurancecharges;

    /**
     * @var string|null
     */
    private $othercharges;

    /**
     * @var string|null
     */
    private $discounts;


    /**
     * Get proformaPk.
     *
     * @return int
     */
    public function getProformaPk()
    {
        return $this->proformaPk;
    }

    /**
     * Set shipmentpackageitemsFk.
     *
     * @param int $shipmentpackageitemsFk
     *
     * @return Proforma
     */
    public function setShipmentpackageitemsFk($shipmentpackageitemsFk)
    {
        $this->shipmentpackageitemsFk = $shipmentpackageitemsFk;

        return $this;
    }

    /**
     * Get shipmentpackageitemsFk.
     *
     * @return int
     */
    public function getShipmentpackageitemsFk()
    {
        return $this->shipmentpackageitemsFk;
    }

    /**
     * Set number.
     *
     * @param int $number
     *
     * @return Proforma
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number.
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set linenumber.
     *
     * @param int $linenumber
     *
     * @return Proforma
     */
    public function setLinenumber($linenumber)
    {
        $this->linenumber = $linenumber;

        return $this;
    }

    /**
     * Get linenumber.
     *
     * @return int
     */
    public function getLinenumber()
    {
        return $this->linenumber;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Proforma
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set freightcharges.
     *
     * @param string|null $freightcharges
     *
     * @return Proforma
     */
    public function setFreightcharges($freightcharges = null)
    {
        $this->freightcharges = $freightcharges;

        return $this;
    }

    /**
     * Get freightcharges.
     *
     * @return string|null
     */
    public function getFreightcharges()
    {
        return $this->freightcharges;
    }

    /**
     * Set insurancecharges.
     *
     * @param string|null $insurancecharges
     *
     * @return Proforma
     */
    public function setInsurancecharges($insurancecharges = null)
    {
        $this->insurancecharges = $insurancecharges;

        return $this;
    }

    /**
     * Get insurancecharges.
     *
     * @return string|null
     */
    public function getInsurancecharges()
    {
        return $this->insurancecharges;
    }

    /**
     * Set othercharges.
     *
     * @param string|null $othercharges
     *
     * @return Proforma
     */
    public function setOthercharges($othercharges = null)
    {
        $this->othercharges = $othercharges;

        return $this;
    }

    /**
     * Get othercharges.
     *
     * @return string|null
     */
    public function getOthercharges()
    {
        return $this->othercharges;
    }

    /**
     * Set discounts.
     *
     * @param string|null $discounts
     *
     * @return Proforma
     */
    public function setDiscounts($discounts = null)
    {
        $this->discounts = $discounts;

        return $this;
    }

    /**
     * Get discounts.
     *
     * @return string|null
     */
    public function getDiscounts()
    {
        return $this->discounts;
    }
}
