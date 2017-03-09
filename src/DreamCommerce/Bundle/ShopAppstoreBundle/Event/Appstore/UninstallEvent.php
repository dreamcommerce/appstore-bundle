<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore;


/**
 * Class UninstallEvent
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore
 */
final class UninstallEvent extends PackageEventAbstract
{
    const ACTION = 'uninstall';
}