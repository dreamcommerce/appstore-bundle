<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 16:58
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


interface BillingInterface
{
    public function setShop(ShopInterface $shop = null);

    public function getShop();

}