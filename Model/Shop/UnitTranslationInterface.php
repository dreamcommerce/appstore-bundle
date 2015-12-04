<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface UnitTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return UnitInterface
     */
    public function getUnit();

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit($unit);
}