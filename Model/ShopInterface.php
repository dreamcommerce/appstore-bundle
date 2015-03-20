<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 16:53
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


/**
 * Shop
 *
 * @ORM\Table(name="Shop", indexes={@ORM\Index(name="shop", columns={"shop"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
interface ShopInterface
{
    /**
     * Set shop
     *
     * @param string $shop
     * @return Shop
     */
    public function setShop($shop);

    /**
     * Get shop
     *
     * @return string
     */
    public function getShop();

    /**
     * Set shopUrl
     *
     * @param string $shopUrl
     * @return Shop
     */
    public function setShopUrl($shopUrl);

    /**
     * Get shopUrl
     *
     * @return string
     */
    public function getShopUrl();
}