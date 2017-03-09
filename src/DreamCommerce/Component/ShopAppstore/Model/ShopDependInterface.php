<?php
namespace DreamCommerce\Component\ShopAppstore\Model;


interface ShopDependInterface
{
    public function getShop();
    public function setShop(ShopInterface $shop);
}