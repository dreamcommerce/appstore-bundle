<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface StatusTranslationInterface extends TranslationInterface
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