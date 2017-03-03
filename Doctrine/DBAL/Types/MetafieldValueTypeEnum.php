<?php
namespace DreamCommerce\ShopAppstoreBundle\Doctrine\DBAL\Types;

use DreamCommerce\Component\Common\Doctrine\DBAL\Types\EnumType;
use DreamCommerce\ShopAppstoreBundle\Model\Shop\MetafieldValueInterface;

class MetafieldValueTypeEnum extends EnumType
{
    const TYPE_NAME = 'enumMetafieldValueType';

    protected $name = self::TYPE_NAME;


    protected $values = [
        MetafieldValueInterface::TYPE_INT,
        MetafieldValueInterface::TYPE_FLOAT,
        MetafieldValueInterface::TYPE_STRING,
        MetafieldValueInterface::TYPE_BLOB
    ];
}