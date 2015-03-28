<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-23
 * Time: 18:07
 */

namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class ShopManager implements ShopManagerInterface
{

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
    }

    public function findAll(){
        return $this->repository->findAll();
    }

    public function findByCriteria($criteria){
        return $this->repository->findBy($criteria);
    }

    public function findShopByName($name)
    {
        $result = $this->findByCriteria(array(
            'name'=>$name,
        ));

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }

    public function create(){
        /**
         * @var $class ShopInterface
         */
        $className = $this->repository->getClassName();
        $class = new $className;
        return $class;
    }

    public function save(ShopInterface $shop){
        $this->em->persist($shop);
        $this->em->flush();
    }

    /**
     * @param $name
     * @param $application
     * @return ShopInterface
     */
    public function findShopByNameAndApplication($name, $application)
    {

        $result = $this->findByCriteria(array(
            'name'=>$name,
            'app'=>$application
        ));

        if($result){
            return $result[0];
        }else{
            return false;
        }
    }
}