<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 12:26
 */

namespace DreamCommerce\ShopAppstoreBundle\EntityManager;


use Doctrine\ORM\EntityManager;
use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;

class TokenManager extends ObjectManager implements TokenManagerInterface{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em, 'DreamCommerce\ShopAppstoreBundle\Model\TokenInterface');
    }

}