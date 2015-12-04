<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface PaymentTranslationInterface extends TranslationInterface, ShopDependentInterface
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