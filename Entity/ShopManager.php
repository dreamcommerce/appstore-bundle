<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-23
 * Time: 18:07
 */

namespace DreamCommerce\ShopAppstoreBundle\Entity;


use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\ShopAppstoreBundle\Model\ShopManager as BaseManager;

class ShopManager extends BaseManager
{

    protected $om;
    protected $class;
    protected $repository;

    public function __construct(ObjectManager $om, $class){
        $this->om = $om;

        $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    public function findAll(){
        return $this->repository->findAll();
    }

    public function findByCriteria($criteria){
        return $this->repository->findBy($criteria);
    }

}