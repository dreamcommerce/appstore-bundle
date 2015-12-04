<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\Currency as CurrencyBase;

class Currency extends CurrencyBase
{
    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->products = new ArrayCollection();

        parent::__construct();
    }
}