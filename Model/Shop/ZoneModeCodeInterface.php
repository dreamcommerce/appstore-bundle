<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ZoneModeCodeInterface extends ZoneInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getCodes();

    /**
     * @param ZoneCodeInterface $code
     * @return $this
     */
    public function addCode(ZoneCodeInterface $code);

    /**
     * @param \ArrayAccess $codes
     * @return $this
     */
    public function setCodes($codes);
}