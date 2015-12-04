<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface UnitInterface extends TranslationDependentInterface, ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}