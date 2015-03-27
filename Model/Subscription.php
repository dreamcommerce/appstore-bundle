<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Subscription implements SubscriptionInterface
{
    protected $expiresAt;

    protected $shop;

    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
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
