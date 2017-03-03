<?php

namespace DreamCommerce\Component\ShopAppstore\Model;

/**
 * Class Subscription
 *
 * subscription information
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
class Subscription implements SubscriptionInterface
{

    /**
     * @var int
     */
    protected $id;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
