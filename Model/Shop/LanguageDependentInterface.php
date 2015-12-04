<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface LanguageDependentInterface
{
    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language);

    /**
     * @return LanguageInterface
     */
    public function getLanguage();
}