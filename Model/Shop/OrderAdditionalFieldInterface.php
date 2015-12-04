<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependentInterface;

interface OrderAdditionalFieldInterface extends ShopDependentInterface
{
    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField();

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField);

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