<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Subscription
 *
 * subscription information
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Subscription extends ShopDependent implements SubscriptionInterface
{
    /**
     * expiration date
     * @var \DateTime
     */
    protected $expiresAt;

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
}
