<?php


namespace DreamCommerce\ShopAppstoreBundle\Doctrine;


use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop as ShopBase;

class Shop extends ShopBase
{
    public function __construct(){
        $this->subscriptions = new ArrayCollection();
    }
}