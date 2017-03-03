<?php
namespace DreamCommerce\ShopAppstoreBundle\Model;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

trait ShopDependTrait
{
    /**
     * @var \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface
     */
    protected $shop;

    /**
     * @return \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }

    /**
     * @param \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface $shop
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }


}