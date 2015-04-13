<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-04-10
 * Time: 21:58
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\BillingInterface;

class BillingManager implements BillingManagerInterface{

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
    }

    public function save(BillingInterface $billingInterface)
    {
        $this->em->persist($billingInterface);
        $this->em->flush();
    }
}