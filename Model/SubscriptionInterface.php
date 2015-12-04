<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Interface SubscriptionInterface
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
interface SubscriptionInterface extends ShopDependentInterface
{
    /**
     * set expiration date
     * @param \DateTime $expiresAt
     * @return void
     */
    public function setExpiresAt(\DateTime $expiresAt);

    /**
     * get expiration date
     * @return \DateTime
     */
    public function getExpiresAt();
}