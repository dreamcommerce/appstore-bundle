<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 17:00
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopRepositoryInterface;

interface ShopManagerInterface extends AbstractManagerInterface
{

    /**
     * @return ShopRepositoryInterface
     */
    public function getRepository();
    /**
     * @return ShopInterface
     */
    public function create();

    /**
     * @param $entity
     * @param bool|true $commit
     * @return mixed
     */
    public function save($entity, $commit = true);

}