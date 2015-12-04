<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface DeliveryTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return DeliveryInterface
     */
    public function getDelivery();

    /**
     * @param DeliveryInterface $delivery
     * @return $this
     */
    public function setDelivery(DeliveryInterface $delivery);
}