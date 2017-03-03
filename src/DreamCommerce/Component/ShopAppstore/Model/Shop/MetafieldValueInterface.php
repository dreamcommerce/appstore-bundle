<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


use Sylius\Component\Resource\Model\ResourceInterface;

interface MetafieldValueInterface extends ResourceInterface
{
    const TYPE_INT      = 'TYPE_INT';
    const TYPE_FLOAT    = 'TYPE_FLOAT';
    const TYPE_STRING   = 'TYPE_STRING';
    const TYPE_BLOB     = 'TYPE_BLOB';

    public function getType(): int;

    public function getMetafield(): Metafield;
    public function setMetafield(Metafield $metafield);

    public function getExternalObjectId(): int;
    public function setExternalObjectId(int $id);

    public function getValue();
    public function setValue($value);
}