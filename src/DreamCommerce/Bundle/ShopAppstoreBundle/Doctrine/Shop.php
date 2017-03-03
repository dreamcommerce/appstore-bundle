<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Doctrine;


use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\Component\ShopAppstore\Model\Shop as ShopBase;

class Shop extends ShopBase
{
    public function __construct(){
        $this->subscriptions = new ArrayCollection();
    }
}