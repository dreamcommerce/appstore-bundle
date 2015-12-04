<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ProductFileInterface extends ResourceDependentInterface
{
    /**
     * @return ProductTranslationInterface
     */
    public function getProductTranslation();

    /**
     * @param ProductTranslationInterface $productTranslation
     * @return $this
     */
    public function setProductTranslation(ProductTranslationInterface $productTranslation);
}