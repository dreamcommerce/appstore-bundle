<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface StatusTranslationInterface extends TranslationInterface, ShopDependentInterface
{
    /**
     * @return StatusInterface
     */
    public function getStatus();

    /**
     * @param StatusInterface $status
     * @return $this
     */
    public function setStatus(StatusInterface $status);
}