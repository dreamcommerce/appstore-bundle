<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface AdditionalFieldTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField();

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField);
}