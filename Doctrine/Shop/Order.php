<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\Order as OrderBase;

class Order extends OrderBase
{
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->additionalFields = new ArrayCollection();

        parent::__construct();
    }
}