<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

interface ShopDependentInterface
{
    /**
     * set shop
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);

    /**
     * get shop
     * @return ShopInterface
     */
    public function getShop();
}