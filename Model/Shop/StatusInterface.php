<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface StatusInterface extends TranslationDependentInterface, ResourceDependentInterface
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
}