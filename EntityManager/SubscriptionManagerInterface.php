<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:30
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface;

interface SubscriptionManagerInterface extends AbstractManagerInterface
{
    /**
     * @return SubscriptionInterface
     */
    public function create();

    /**
     * @param SubscriptionInterface $entity
     * @param bool|true $commit
     * @return mixed
     */
    public function save($entity, $commit = true);
}