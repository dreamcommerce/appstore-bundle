<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface ShippingTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return ShippingInterface
     */
    public function getShipping();

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function setShipping(ShippingInterface $shipping);
}