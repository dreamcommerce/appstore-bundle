<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface SubscriberGroupInterface extends ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getSubscribers();

    /**
     * @param SubscriberInterface $subscriber
     * @return $this
     */
    public function addSubscriber(SubscriberInterface $subscriber);

    /**
     * @param \ArrayAccess $subscribers
     * @return $this
     */
    public function setSubscribers($subscribers);
}