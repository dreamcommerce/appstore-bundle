<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface MetafieldInterface extends ResourceDependentInterface
{
    /**
     * @return MetafieldValueInterface
     */
    public function getMetafieldValue();

    /**
     * @param MetafieldValueInterface $metafieldValue
     * @return $this
     */
    public function setMetafieldValue(MetafieldValueInterface $metafieldValue);

    /**
     * @return ResourceInterface|string
     */
    public function getObject();

    /**
     * @param ResourceInterface|string $object
     * @return $this
     */
    public function setObject($object);
}