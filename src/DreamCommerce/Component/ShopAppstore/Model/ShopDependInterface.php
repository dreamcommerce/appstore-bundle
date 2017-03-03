<?php
namespace DreamCommerce\Component\ShopAppstore\Model;


interface ShopDependInterface
{
    public function getShop(): ShopInterface;
    public function setShop(ShopInterface $shop);
}