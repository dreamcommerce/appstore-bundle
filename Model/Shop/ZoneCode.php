<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

use DreamCommerce\ShopAppstoreBundle\Model\ShopDependent;

class ZoneCode extends ShopDependent
{
    /**
     * @var int
     */
    protected $codeId;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @var ZoneModeCodeInterface
     */
    protected $zoneModeCode;

    /**
     * @return int
     */
    public function getCodeId()
    {
        return $this->codeId;
    }

    /**
     * @param int $codeId
     */
    public function setCodeId($codeId)
    {
        $this->codeId = $codeId;
    }

    /**
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }
}