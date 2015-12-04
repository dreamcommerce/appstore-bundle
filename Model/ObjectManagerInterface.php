<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Interface ObjectManagerInterface
 *
 * object manager used to manipulate data
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
interface ObjectManagerInterface
{
    /**
     * return data manipulator repository
     * @param $class
     * @return RepositoryInterface
     */
    public function getRepository($class);

    /**
     * delete an entity
     * @param $entity
     * @return mixed
     */
    public function delete($entity);

    /**
     * save entity state
     * @param $entity
     * @param bool|true $commit
     * @return mixed
     */
    public function save($entity, $commit = true);

    /**
     * create an entity based on shop interface - it resolves interface-entity mapping
     * @param $class
     * @return mixed
     */
    public function create($class);
}