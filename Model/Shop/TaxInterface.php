<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface TaxInterface extends ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getProducts();

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product);

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products);
}