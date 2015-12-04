<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class ZoneModeCode extends Zone implements ZoneModeCodeInterface
{
    /**
     * @var \ArrayAccess
     */
    protected $codes;

    public function __construct()
    {
        $this->codes = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return \ArrayAccess
     */
    public function getCodes()
    {
        return $this->codes;
    }

    /**
     * @param ZoneCodeInterface $code
     * @return $this
     */
    public function addCode(ZoneCodeInterface $code)
    {
        $this->codes[] = $code;
        return $this;
    }

    /**
     * @param \ArrayAccess $codes
     * @return $this
     */
    public function setCodes($codes)
    {
        $this->codes = $codes;
        return $this;
    }
}