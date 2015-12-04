<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface OrderProductInterface extends ResourceDependentInterface
{
    /**
     * @return OrderInterface
     */
    public function getOrder();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order);

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