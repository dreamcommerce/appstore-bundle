<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface GaugeTranslationInterface extends LanguageDependentInterface, ShopDependentInterface
{
    /**
     * @return GaugeInterface
     */
    public function getGauge();

    /**
     * @param GaugeInterface $gauge
     * @return $this
     */
    public function setGauge(GaugeInterface $gauge);
}