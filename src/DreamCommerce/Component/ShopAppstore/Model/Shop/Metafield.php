<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;


use Doctrine\Common\Collections\Collection;
use DreamCommerce\Component\ShopAppstore\Model\ShopDependInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopDependTrait;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

class Metafield implements MetafieldInterface, ShopDependInterface, ResourceInterface
{
    use ShopDependTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $metafieldExternalId;

    /**
     * @var string
     */
    protected $metafieldKey;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $object;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    protected $metafieldValues;

    /**
     * @var \DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
     */
    protected $shop;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->metafieldsString = new \Doctrine\Common\Collections\ArrayCollection();
        $this->metafieldValues = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set metafieldId
     *
     * @param integer $metafieldId
     *
     * @return Metafield
     */
    public function setMetafieldExternalId(int $metafieldId)
    {
        $this->metafieldExternalId = $metafieldId;

        return $this;
    }

    /**
     * Get metafieldId
     *
     * @return integer
     */
    public function getMetafieldExternalId(): int
    {
        return $this->metafieldExternalId;
    }

    /**
     * Set metafieldKey
     *
     * @param string $metafieldKey
     *
     * @return Metafield
     */
    public function setMetafieldKey(string $metafieldKey)
    {
        $this->metafieldKey = $metafieldKey;

        return $this;
    }

    /**
     * Get metafieldKey
     *
     * @return string
     */
    public function getMetafieldKey(): string
    {
        return $this->metafieldKey;
    }

    /**
     * Set namespace
     *
     * @param string $namespace
     *
     * @return Metafield
     */
    public function setNamespace(string $namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }

    /**
     * Get namespace
     *
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->namespace;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Metafield
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set object
     *
     * @param string|null $object
     *
     * @return Metafield
     */
    public function setObject($object=null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }
    /**
     * Add metafieldValue
     *
     * @param MetafieldValue $metafield
     *
     * @return Metafield
     */
    public function addMetafieldValue(MetafieldValue $metafieldValues)
    {
        $this->metafieldValues[] = $metafieldValues;

        return $this;
    }

    /**
     * Remove MetafieldValue
     *
     * @param MetafieldValue $metafield
     */
    public function removeMetafieldValue(MetafieldValue $metafield)
    {
        $this->metafieldValues->removeElement($metafield);
    }

    /**
     * Get MetafieldValues
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMetafieldValues(): Collection
    {
        return $this->metafieldValues;
    }

    /**
     * @param ShopInterface $shop
     * @return $this
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * @return ShopInterface
     */
    public function getShop(): ShopInterface
    {
        return $this->shop;
    }
}
