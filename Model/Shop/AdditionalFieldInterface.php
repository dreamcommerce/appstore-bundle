<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

/**
 * Interface AdditionalFieldInterface
 * @package DreamCommerce\Model\Entity\Shop
 */
interface AdditionalFieldInterface extends ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getTranslations();

    /**
     * @param AdditionalFieldTranslationInterface $translation
     * @return $this
     */
    public function addTranslation(AdditionalFieldTranslationInterface $translation);

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations);
}