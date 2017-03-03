<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Model;

use DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface;

trait ShopDependTrait
{
    /**
     * @var \DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface
     */
    protected $shop;

    /**
     * @return \DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }

    /**
     * @param \DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface $shop
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }


}