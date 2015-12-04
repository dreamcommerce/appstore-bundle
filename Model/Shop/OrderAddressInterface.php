<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface OrderAddressInterface extends AddressInterface
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
}