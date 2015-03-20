<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 16:58
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;


/**
 * Billing
 *
 * @ORM\Table(name="Billing", indexes={@ORM\Index(name="shop_id", columns={"shop_id"})})
 * @ORM\Entity(repositoryClass="BillingRepository")
 * @ORM\HasLifecycleCallbacks
 */
interface BillingInterface
{
    /**
     * Set shop
     *
     * @param ShopInterface $shop
     * @return Billing
     */
    public function setShop(ShopInterface $shop = null);

    /**
     * Get shop
     *
     * @return ShopInterface
     */
    public function getShop();

    /**
     * @return integer
     */
    public function getId();
}