<?php
namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;


class MetafieldValueString extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type = MetafieldValueInterface::TYPE_STRING;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return (string)$this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = (string)$value;
    }



}
