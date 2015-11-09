<?php
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use DreamCommerce\ShopAppstoreBundle\Model\BillingInterface;

/**
 * Interface BillingManagerInterface
 * @package DreamCommerce\ShopAppstoreBundle\EntityManager
 */
interface BillingManagerInterface extends AbstractManagerInterface
{
    /**
     * @return BillingInterface
     */
    public function create();

    /**
     * @param BillingInterface $entity
     * @param bool|true $commit
     */
    public function save($entity, $commit = true);
}