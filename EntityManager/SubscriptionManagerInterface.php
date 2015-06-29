<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:30
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface;

interface SubscriptionManagerInterface
{
    public function save(SubscriptionInterface $subscription);
}