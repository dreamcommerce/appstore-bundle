<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface CurrencyInterface extends ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getOrders();

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function addOrder(OrderInterface $order);

    /**
     * @param \ArrayAccess $orders
     * @return $this
     */
    public function setOrders($orders);

    /**
     * @return \ArrayAccess
     */
    public function getPayments();

    /**
     * @param PaymentInterface $payment
     * @return $this
     */
    public function addPayment(PaymentInterface $payment);

    /**
     * @param \ArrayAccess $payments
     * @return $this
     */
    public function setPayments($payments);

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