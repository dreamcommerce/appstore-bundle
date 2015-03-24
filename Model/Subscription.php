<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Subscription implements SubscriptionInterface
{
    protected $id;

    protected $expiresAt;

    protected $shop;

    public function getId()
    {
        return $this->id;
    }

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
