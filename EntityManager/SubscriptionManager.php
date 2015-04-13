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

class SubscriptionManager implements SubscriptionManagerInterface{

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
    }

    public function save(SubscriptionInterface $subscription)
    {
        $this->em->persist($subscription);
        $this->em->flush();
    }
}