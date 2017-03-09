<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore;

/**
 * Class BillingInstallEvent
 * billing user paid for application
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore
 */
final class BillingInstallEvent extends PackageEventAbstract
{
    const ACTION = 'billing_install';
}