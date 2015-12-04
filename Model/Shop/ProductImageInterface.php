<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ProductImageInterface extends ResourceDependentInterface
{
    /**
     * @return ProductInterface
     */
    public function getProduct();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function setProduct(ProductInterface $product);
}