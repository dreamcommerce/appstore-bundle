<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Model;

/**
 * Interface BillingInterface
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Model
 */
interface BillingInterface
{
    /**
     * set shop
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop);

    /**
     * get shop
     * @return ShopInterface
     */
    public function getShop();

    /**
     * get event creation date
     * @return \DateTime
     */
    public function getCreatedAt();

}