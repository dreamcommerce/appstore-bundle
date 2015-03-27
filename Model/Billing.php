<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Billing implements BillingInterface
{
    protected $shop;

    public function setShop(ShopInterface $shop = null)
    {
        $this->shop = $shop;

        return $this;
    }

    public function getShop()
    {
        return $this->shop;
    }

}
