<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


class MetafieldValueBlob extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type = MetafieldValueInterface::TYPE_BLOB;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
