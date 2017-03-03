<?php
namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;


class MetafieldValueInt extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type = MetafieldValueInterface::TYPE_INT;

    /**
     * @var int
     */
    protected $value;

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


}
