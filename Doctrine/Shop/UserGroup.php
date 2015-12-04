<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\UserGroup as UserGroupBase;

class UserGroup extends UserGroupBase
{
    public function __construct()
    {
        $this->users = new ArrayCollection();

        parent::__construct();
    }
}