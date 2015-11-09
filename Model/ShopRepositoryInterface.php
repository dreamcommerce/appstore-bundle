<?php


namespace DreamCommerce\ShopAppstoreBundle\Model;


interface ShopRepositoryInterface
{

    /**
     * @param $application
     * @return ShopInterface[]
     */
    public function findByApplication($application);

    /**
     * @param $name
     * @return ShopInterface
     */
    public function findOneByName($name);

    /**
     * @param $name
     * @param $application
     * @return ShopInterface
     */
    public function findOneByNameAndApplication($name, $application);
}