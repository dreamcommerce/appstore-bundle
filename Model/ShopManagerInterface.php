<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 17:00
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;

interface ShopManagerInterface
{
    public function findShopByName($name);

    /**
     * @param $name
     * @param $application
     * @return ShopInterface
     */
    public function findShopByNameAndApplication($name, $application);
}