<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\AdditionalField as AdditionalFieldBase;

class AdditionalField extends AdditionalFieldBase
{
    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }
}