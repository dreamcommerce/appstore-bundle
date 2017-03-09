<?php
namespace DreamCommerce\Component\ShopAppstore\Model;


interface DiscriminatorMappingInterface
{
    /**
     * Get mapping information to class for mapping by discriminator (entity field)
     *
     * Should return array similar to:
     * [
     *      TYPE_VALUE1    => Full\Qualified\NameSpace\To\Mapping\Class1,
     *      TYPE_VALUE2    => Full\Qualified\NameSpace\To\Mapping\Class2,
     *      TYPE_VALUE3    => Full\Qualified\NameSpace\To\Mapping\Class3,
     * ];
     *
     * @return array
     */
    public static function getMapClass(): array;

    /**
     * Get mapping information to database value for mapping by discriminator
     *
     * Should return array similar to:
     * [
     *      TYPE_VALUE1    => 1,
     *      TYPE_VALUE2    => 2,
     *      TYPE_VALUE3    => 3,
     * ];
     * @return array
     */
    public static function getMapDatabase(): array;
}