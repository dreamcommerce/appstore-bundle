<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Shipping extends ResourceDependent implements ShippingInterface
{
    /**
     * @var int
     */
    protected $shippingId;

    /**
     * @var float
     */
    protected $cost;

    /**
     * @var int
     */
    protected $dependOnW;

    /**
     * @var float
     */
    protected $maxWeight;

    /**
     * @var float
     */
    protected $minWeight;

    /**
     * @var float
     */
    protected $freeShipping;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $pkwiu;

    /**
     * @var float
     */
    protected $maxCost;

    /**
     * @var TaxInterface
     */
    protected $tax;

    /**
     * @var ZoneInterface
     */
    protected $zone;

    /**
     * @var \ArrayAccess
     */
    protected $payments;

    /**
     * @var \ArrayAccess
     */
    protected $gauges;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    public function __construct()
    {
        $this->ranges = new \ArrayObject();
        $this->payments = new \ArrayObject();
        $this->gauges = new \ArrayObject();
        $this->translations = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getShippingId()
    {
        return $this->shippingId;
    }

    /**
     * @param int $shippingId
     * @return $this
     */
    public function setShippingId($shippingId)
    {
        $this->shippingId = $shippingId;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return $this
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
        return $this;
    }

    /**
     * @return int
     */
    public function getDependOnW()
    {
        return $this->dependOnW;
    }

    /**
     * @param int $dependOnW
     * @return $this
     */
    public function setDependOnW($dependOnW)
    {
        $this->dependOnW = $dependOnW;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param float $maxWeight
     * @return $this
     */
    public function setMaxWeight($maxWeight)
    {
        $this->maxWeight = $maxWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getMinWeight()
    {
        return $this->minWeight;
    }

    /**
     * @param float $minWeight
     * @return $this
     */
    public function setMinWeight($minWeight)
    {
        $this->minWeight = $minWeight;
        return $this;
    }

    /**
     * @return float
     */
    public function getFreeShipping()
    {
        return $this->freeShipping;
    }

    /**
     * @param float $freeShipping
     * @return $this
     */
    public function setFreeShipping($freeShipping)
    {
        $this->freeShipping = $freeShipping;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string
     */
    public function getPkwiu()
    {
        return $this->pkwiu;
    }

    /**
     * @param string $pkwiu
     * @return $this
     */
    public function setPkwiu($pkwiu)
    {
        $this->pkwiu = $pkwiu;
        return $this;
    }

    /**
     * @return float
     */
    public function getMaxCost()
    {
        return $this->maxCost;
    }

    /**
     * @param float $maxCost
     * @return $this
     */
    public function setMaxCost($maxCost)
    {
        $this->maxCost = $maxCost;
        return $this;
    }

    /**
     * @return TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getRanges()
    {
        return $this->ranges;
    }

    /**
     * @param ShippingRange $range
     * @return $this
     */
    public function addRange(ShippingRange $range)
    {
        $this->ranges[] = $range;
        return $this;
    }

    /**
     * @param \ArrayAccess $ranges
     * @return $this
     */
    public function setRanges($ranges)
    {
        $this->ranges = $ranges;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment)
    {
        $this->payments[] = $payment;
        return $this;
    }

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getGauges()
    {
        return $this->gauges;
    }

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function addGauge(GaugeInterface $gauge)
    {
        $this->gauges[] = $gauge;
        return $this;
    }

    /**
     * @param \ArrayAccess $gauges
     * @return $this
     */
    public function setGauges($gauges)
    {
        $this->gauges = $gauges;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param TranslationInterface $translation
     * @return $this
     */
    public function addTranslation(TranslationInterface $translation)
    {
        $this->translations[] = $translation;
        return $this;
    }

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return ZoneInterface
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * @param ZoneInterface $zone
     * @return $this
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Shipping';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->shippingId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->shippingId = $id;
        return $this;
    }
}