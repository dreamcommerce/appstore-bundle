<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:31
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;

interface TokenManagerInterface extends AbstractManagerInterface
{
    /**
     * @return TokenInterface
     */
    public function create();

    /**
     * @param TokenInterface $entity
     * @param bool|true $commit
     * @return mixed
     */
    public function save($entity, $commit = true);
}