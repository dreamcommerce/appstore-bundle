<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore;

/**
 * Class SubscriptionEvent
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore
 */
final class SubscriptionEvent extends PackageEventAbstract
{
    const ACTION = 'billing_subscription';
}