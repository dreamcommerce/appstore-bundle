<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

abstract class MetafieldValue extends ResourceDependent implements MetafieldValueInterface
{
    /**
     * @var int
     */
    protected $valueId;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var MetafieldInterface
     */
    protected $metafield;

    /**
     * @return int
     */
    public function getValueId()
    {
        return $this->valueId;
    }

    /**
     * @param int $valueId
     * @return $this
     */
    public function setValueId($valueId)
    {
        $this->valueId = $valueId;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return MetafieldInterface
     */
    public function getMetafield()
    {
        return $this->metafield;
    }

    /**
     * @param MetafieldInterface $metafield
     * @return $this
     */
    public function setMetafield(MetafieldInterface $metafield)
    {
        $this->metafield = $metafield;
        return $this;
    }
}