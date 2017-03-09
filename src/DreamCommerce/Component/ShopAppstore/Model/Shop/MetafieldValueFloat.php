<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


class MetafieldValueFloat extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type;// = MetafieldValueInterface::TYPE_FLOAT;

    /**
     * @var float
     */
    protected $value;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
