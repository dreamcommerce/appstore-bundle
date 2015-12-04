<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface ParcelProductInterface extends ShopDependentInterface
{
    /**
     * @return ParcelInterface
     */
    public function getParcel();

    /**
     * @param ParcelInterface $parcel
     * @return $this
     */
    public function setParcel(ParcelInterface $parcel);

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
     * @return ProductStockInterface
     */
    public function getProductStock();

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function setProductStock(ProductStockInterface $productStock);
}