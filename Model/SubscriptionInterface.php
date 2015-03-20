<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-19
 * Time: 14:27
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


/**
 * Subscription
 *
 * @ORM\Table(name="Subscription", indexes={@ORM\Index(name="shop_id", columns={"shop_id"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
interface SubscriptionInterface
{
    /**
     * Set expiresAt
     *
     * @param \DateTime $expiresAt
     * @return Subscription
     */
    public function setExpiresAt($expiresAt);

    /**
     * Get expiresAt
     *
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * Set shop
     *
     * @param Shop $shop
     * @return Subscription
     */
    public function setShop(Shop $shop = null);

    /**
     * Get shop
     *
     * @return Shop
     */
    public function getShop();
}