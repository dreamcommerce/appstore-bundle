<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class ShopDependent implements ShopDependentInterface
{
    /**
     * shop this information is bound to
     * @var ShopInterface
     */
    protected $shop;

    public function __construct()
    {

    }

    /**
     * @return ShopInterface
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
        return $shop;
    }
}