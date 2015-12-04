<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependent;

abstract class OrderAdditionalField extends ShopDependent implements OrderAdditionalFieldInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * @var AdditionalFieldInterface
     */
    protected $additionalField;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField()
    {
        return $this->additionalField;
    }

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField)
    {
        $this->additionalField = $additionalField;
        return $this;
    }

    /**
     * @return OrderInterface
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     * @return $this
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
        return $this;
    }
}