<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Subscription
 *
 * subscription information
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Subscription implements SubscriptionInterface
{
    /**
     * expiration date
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * shop instance
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @inheritdoc
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }

    /**
     * @inheritdoc
     */
    public function getShop()
    {
        return $this->shop;
    }
}
