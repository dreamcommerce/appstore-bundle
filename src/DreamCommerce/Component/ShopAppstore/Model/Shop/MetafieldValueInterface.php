<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


use DreamCommerce\Component\ShopAppstore\Model\DiscriminatorMappingInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface MetafieldValueInterface extends ResourceInterface, DiscriminatorMappingInterface
{
    const TYPE_INT      = 'INT';
    const TYPE_FLOAT    = 'FLOAT';
    const TYPE_STRING   = 'STRING';
    const TYPE_BLOB     = 'BLOB';

    public function getType();

    public function getMetafield();
    public function setMetafield(Metafield $metafield);

    public function getExternalObjectId();
    public function setExternalObjectId(int $id);

    public function getValue();
    public function setValue($value);
}