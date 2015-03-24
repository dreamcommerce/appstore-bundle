<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Billing implements BillingInterface
{
    protected $id;
    protected $shop;

    public function getId()
    {
        return $this->id;
    }

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
