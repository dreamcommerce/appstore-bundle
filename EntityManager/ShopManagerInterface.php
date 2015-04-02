<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 17:00
 */
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

interface ShopManagerInterface
{
    public function findShopByName($name);

    /**
     * @param $name
     * @param $application
     * @return ShopInterface
     */
    public function findShopByNameAndApplication($name, $application);

    /**
     * @return ShopInterface
     */
    public function create();

    public function save(ShopInterface $shop);

    public function delete(ShopInterface $shop);
}