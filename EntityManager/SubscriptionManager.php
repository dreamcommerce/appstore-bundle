<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-10
 * Time: 21:58
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface;

class SubscriptionManager extends ObjectManager implements SubscriptionManagerInterface{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, 'DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface');
    }

}