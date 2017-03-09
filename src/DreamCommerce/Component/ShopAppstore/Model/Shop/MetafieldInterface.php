<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


use Doctrine\Common\Collections\Collection;

interface MetafieldInterface
{
    const OBJECT_SYSTEM = 'system';

    public function setMetafieldExternalId(int $metafieldId);
    public function getMetafieldExternalId();
    public function setMetafieldKey(string $metafieldKey);
    public function getMetafieldKey();
    public function setNamespace(string $namespace);
    public function getNamespace();
    public function setDescription(string $description);
    public function getDescription();
    public function setObject($object=null);
    public function getObject();
    public function getId();
    public function addMetafieldValue(MetafieldValue $metafieldValues);
    public function removeMetafieldValue(MetafieldValue $metafield);
    public function getMetafieldValues(): Collection;
    public function setType(string $type);
    public function getType();
}