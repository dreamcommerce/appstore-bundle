<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface AvailabilityTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return AvailabilityInterface
     */
    public function getAvailability();

    /**
     * @param AvailabilityInterface $availability
     * @return $this
     */
    public function setAvailability(AvailabilityInterface $availability);
}