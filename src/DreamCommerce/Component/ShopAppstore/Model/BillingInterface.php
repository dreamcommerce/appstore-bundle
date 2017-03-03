<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface BillingInterface
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface BillingInterface extends ResourceInterface
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
    public function getCreatedAt(): \DateTime;

}