<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\Subscriber as SubscriberBase;

class Subscriber extends SubscriberBase
{
    public function __construct()
    {
        $this->groups = new ArrayCollection();

        parent::__construct();
    }
}