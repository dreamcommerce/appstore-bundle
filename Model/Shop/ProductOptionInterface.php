<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface ProductOptionInterface extends ShopDependentInterface
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

    /**
     * @return OptionInterface
     */
    public function getOption();

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function setOption(OptionInterface $option);
}