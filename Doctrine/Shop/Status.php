<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\Status as StatusBase;

class Status extends StatusBase
{
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->orders = new ArrayCollection();

        parent::__construct();
    }
}