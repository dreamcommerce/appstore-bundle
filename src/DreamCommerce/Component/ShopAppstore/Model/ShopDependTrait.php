<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

trait ShopDependTrait
{
    /**
     * @var \DreamCommerce\Component\ShopAppstore\Model\ShopInterface
     */
    protected $shop;

    /**
     * @return \DreamCommerce\Component\ShopAppstore\Model\ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }

    /**
     * @param \DreamCommerce\Component\ShopAppstore\Model\ShopInterface $shop
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }


}