<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

/**
 * Class AdditionalField
 * @package DreamCommerce\ShopAppstoreBundle\Model\Shop
 */
abstract class AdditionalField extends ResourceDependent implements AdditionalFieldInterface
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var int
     */
    protected $locate;

    /**
     * @var boolean
     */
    protected $req;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
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
     * @return int
     */
    public function getLocate()
    {
        return $this->locate;
    }

    /**
     * @param int $locate
     * @return $this
     */
    public function setLocate($locate)
    {
        $this->locate = $locate;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isReq()
    {
        return $this->req;
    }

    /**
     * @param boolean $req
     * @return $this
     */
    public function setReq($req)
    {
        $this->req = $req;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param AdditionalFieldTranslationInterface $translation
     * @return $this
     */
    public function addTranslation(AdditionalFieldTranslationInterface $translation)
    {
        $this->translations[] = $translation;
        return $this;
    }

    /**
     * @param \ArrayAccess $translations
     * @return $this
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\AdditionalField';
    }
}
