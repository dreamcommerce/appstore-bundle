<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Doctrine\DBAL\Types;


use DreamCommerce\Bundle\ShopAppstoreBundle\Model\Shop\MetafieldValueInterface;
use DreamCommerce\Component\Common\Doctrine\DBAL\Types\MapEnumType;

class MetafieldValueTypeUInt8 extends MapEnumType
{
    const TYPE_NAME = 'enumMetafieldValueTypeUInt8';

    protected $enumType = self::TYPE_UINT8;

    protected $name = self::TYPE_NAME;


    protected $values = [
        MetafieldValueInterface::TYPE_INT    => 1,
        MetafieldValueInterface::TYPE_FLOAT  => 2,
        MetafieldValueInterface::TYPE_STRING => 3,
        MetafieldValueInterface::TYPE_BLOB   => 4
    ];
}