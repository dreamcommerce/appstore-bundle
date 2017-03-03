<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface SubscriptionInterface
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface SubscriptionInterface extends ResourceInterface
{
    /**
     * set expiration date
     * @param \DateTime $expiresAt
     * @return void
     */
    public function setExpiresAt(\DateTime $expiresAt);

    /**
     * get expiration date
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * set shop for subscription
     * @param ShopInterface $shop
     * @return void
     */
    public function setShop(ShopInterface $shop);

    /**
     * get shop bound to subscription
     * @return ShopInterface
     */
    public function getShop();
}