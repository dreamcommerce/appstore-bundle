<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ShippingTranslationInterface extends TranslationInterface
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