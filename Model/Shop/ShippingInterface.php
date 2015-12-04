<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ShippingInterface extends TranslationDependentInterface, ResourceDependentInterface
{
    /**
     * @return TaxInterface
     */
    public function getTax();

    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax($tax);

    /**
     * @return \ArrayAccess
     */
    public function getPayments();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment);

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments);

    /**
     * @return \ArrayAccess
     */
    public function getGauges();

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function addGauge(GaugeInterface $gauge);

    /**
     * @param \ArrayAccess $gauges
     * @return $this
     */
    public function setGauges($gauges);

    /**
     * @return ZoneInterface
     */
    public function getZone();

    /**
     * @param ZoneInterface $zone
     * @return $this
     */
    public function setZone($zone);
}