<?php
namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Interface BillingInterface
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
interface BillingInterface extends ShopDependentInterface
{
    /**
     * get event creation date
     * @return \DateTime
     */
    public function getCreatedAt();

}