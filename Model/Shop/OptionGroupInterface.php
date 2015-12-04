<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface OptionGroupInterface extends TranslationDependentInterface, ResourceDependentInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getOptions();

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option);

    /**
     * @param \ArrayAccess $options
     * @return $this
     */
    public function setOptions($options);
}