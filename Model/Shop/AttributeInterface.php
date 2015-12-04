<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface AttributeInterface extends ResourceDependentInterface
{
    /**
     * @return AttributeGroupInterface
     */
    public function getAttributeGroup();

    /**
     * @param AttributeGroupInterface $attributeGroup
     * @return $this
     */
    public function setAttributeGroup(AttributeGroupInterface $attributeGroup);
}