<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface OptionValueTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return OptionValueInterface
     */
    public function getOptionValue();

    /**
     * @param OptionValueInterface $optionValue
     * @return $this
     */
    public function setOptionValue(OptionValueInterface $optionValue);
}