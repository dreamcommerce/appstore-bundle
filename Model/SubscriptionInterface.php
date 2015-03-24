<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:27
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


interface SubscriptionInterface
{
    public function setExpiresAt(\DateTime $expiresAt);

    public function getExpiresAt();

    public function setShop(ShopInterface $shop = null);

    public function getShop();
}