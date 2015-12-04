<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface OptionGroupTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return OptionGroupInterface
     */
    public function getOptionGroup();

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup($optionGroup);
}