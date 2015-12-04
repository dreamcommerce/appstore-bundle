<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\SubscriberGroup as SubscriberGroupBase;

class SubscriberGroup extends SubscriberGroupBase
{
    public function __construct()
    {
        $this->subscribers = new ArrayCollection();

        parent::__construct();
    }
}