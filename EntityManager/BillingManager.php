<?php
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;

use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\BillingInterface;

/**
 * Class BillingManager
 * @package DreamCommerce\ShopAppstoreBundle\EntityManager
 */
class BillingManager extends ObjectManager implements BillingManagerInterface{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, 'DreamCommerce\ShopAppstoreBundle\Model\BillingInterface');
    }

}