<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\User as UserBase;

class User extends UserBase
{
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->additionalFields = new ArrayCollection();
        $this->groups = new ArrayCollection();

        parent::__construct();
    }
}