<?php
namespace DreamCommerce\ShopAppstoreBundle\Model;


interface ShopDependInterface
{
    public function getShop(): ShopInterface;
    public function setShop(ShopInterface $shop);
}