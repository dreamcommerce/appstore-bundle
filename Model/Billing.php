<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Billing
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Billing implements BillingInterface
{
    protected $shop;

    protected $createdAt;

    public function __construct(){
        $this->createdAt = new \DateTime();
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

    public function getCreatedAt(){
        return $this->createdAt;
    }

}
