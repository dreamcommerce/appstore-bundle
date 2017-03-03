<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


use Doctrine\Common\Collections\Collection;

interface MetafieldInterface
{
    public function setMetafieldExternalId(int $metafieldId);
    public function getMetafieldExternalId(): int;
    public function setMetafieldKey(string $metafieldKey);
    public function getMetafieldKey(): string;
    public function setNamespace(string $namespace);
    public function getNamespace(): string;
    public function setDescription(string $description);
    public function getDescription(): string;
    public function setObject($object=null);
    public function getObject();
    public function getId(): int;
    public function addMetafieldValue(MetafieldValue $metafieldValues);
    public function removeMetafieldValue(MetafieldValue $metafield);
    public function getMetafieldValues(): Collection;
}