<?php
namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

/**
 * Class ShopManager
 * @package DreamCommerce\ShopAppstoreBundle\EntityManager
 */
class ShopManager extends ObjectManager implements ShopManagerInterface
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, 'DreamCommerce\ShopAppstoreBundle\Model\ShopInterface');
    }
}