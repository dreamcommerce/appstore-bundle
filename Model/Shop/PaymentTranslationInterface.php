<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface PaymentTranslationInterface extends TranslationInterface
{
    /**
     * @return PaymentInterface
     */
    public function getPayment();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function setPayment(PaymentInterface $payment);
}