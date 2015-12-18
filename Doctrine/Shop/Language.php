<?php

namespace DreamCommerce\ShopAppstoreBundle\Doctrine\Shop;

use Doctrine\Common\Collections\ArrayCollection;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\Language as LanguageBase;

class Language extends LanguageBase
{
    public function __construct()
    {
        $this->aboutPages = new ArrayCollection();
        $this->additionalFieldTranslations = new ArrayCollection();
        $this->attributeGroups = new ArrayCollection();
        $this->availabilityTranslations = new ArrayCollection();
        $this->categoryTranslations = new ArrayCollection();
        $this->deliveryTranslations = new ArrayCollection();
        $this->gaugeTranslations = new ArrayCollection();
        $this->paymentTranslations = new ArrayCollection();
        $this->productTranslations = new ArrayCollection();
        $this->shippingTranslations = new ArrayCollection();
        $this->statusTranslations = new ArrayCollection();
        $this->unitTranslations = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->optionGroups = new ArrayCollection();
        $this->optionValues = new ArrayCollection();

        parent::__construct();
    }
}