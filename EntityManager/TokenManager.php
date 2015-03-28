<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 12:26
 */

namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;

class TokenManager implements TokenManagerInterface{

    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class){
        $this->em = $em;
        $this->repository = $em->getRepository($class);
    }

    /**
     * @return TokenInterface
     */
    public function create(){

        /**
         * @var $class TokenInterface
         */
        $className = $this->repository->getClassName();
        $class = new $className;
        return $class;
    }

    public function save(TokenInterface $token){
        $this->em->persist($token);
        $this->em->flush();
    }

}