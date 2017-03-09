<?php
namespace DreamCommerce\Component\ShopAppstore\Model;


interface DiscriminatorMappingInterface
{
    /**
     * Get Mapping information for mapping by discriminator (entity field)
     *
     * Should return array similar to:
     * [
     *      FIELD_VALUE1    => Full\Qualified\NameSpace\To\Mapping\Class1,
     *      FIELD_VALUE2    => Full\Qualified\NameSpace\To\Mapping\Class2,
     *      FIELD_VALUE3    => Full\Qualified\NameSpace\To\Mapping\Class3,
     * ];
     *
     * @return array
     */
    public static function getMap(): array;
}