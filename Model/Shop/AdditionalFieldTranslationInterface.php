<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface AdditionalFieldTranslationInterface extends TranslationInterface
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