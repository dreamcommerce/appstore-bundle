<?php
namespace DreamCommerce\Component\ShopAppstore\Model\Shop;

use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;

abstract class MetafieldValue implements MetafieldValueInterface
{
    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var Metafield
     */
    protected $metafield;

    /**
     * @var int
     */
    protected $externalObjectId;

    /**
     * @var int
     */
    protected $externalMetafieldValueId;

    /**
     * Return discriminator mapping information
     *
     * @return array
     */
    public static function getMap() : array
    {
        return [
            MetafieldValueInterface::TYPE_INT       => MetafieldValueInt::class,
            MetafieldValueInterface::TYPE_FLOAT     => MetafieldValueFloat::class,
            MetafieldValueInterface::TYPE_STRING    => MetafieldValueString::class,
            MetafieldValueInterface::TYPE_BLOB      => MetafieldValueBlob::class
        ];
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Metafield
     */
    public function getMetafield()
    {
        return $this->metafield;
    }

    /**
     * @param \DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield $metafield
     * @throws MetafieldTypeException
     */
    public function setMetafield(Metafield $metafield)
    {
        $metafieldType = $metafield->getType();
        $mapClass      = self::getMap()[$metafieldType];

        if (static::class !== $mapClass) {
            throw new MetafieldTypeException(
                sprintf('Metafield accept only values that are instance of %s. You are trying set instance of %s', $mapClass, static::class)
            );
        }


        $this->metafield = $metafield;
    }

    /**
     * @return int
     */
    public function getExternalObjectId()
    {
        return $this->externalObjectId;
    }

    /**
     * @param int $externalObjectId
     */
    public function setExternalObjectId(int $externalObjectId)
    {
        $this->externalObjectId = $externalObjectId;
    }

    /**
     * @return int
     */
    public function getExternalMetafieldValueId()
    {
        return $this->externalMetafieldValueId;
    }

    /**
     * @param int $externalMetafieldValueId
     */
    public function setExternalMetafieldValueId(int $externalMetafieldValueId)
    {
        $this->externalMetafieldValueId = $externalMetafieldValueId;
    }

    public function setType($type) {
        $this->type = $type;
    }
}
