<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

abstract class Option extends ResourceDependent implements OptionInterface
{
    /**
     * @var int
     */
    protected $optionId;

    /**
     * @var int
     */
    protected $order;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var boolean
     */
    protected $required;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var OptionGroupInterface
     */
    protected $optionGroup;

    public function __construct()
    {
        $this->translations = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getOptionId()
    {
        return $this->optionId;
    }

    /**
     * @param int $optionId
     * @return $this
     */
    public function setOptionId($optionId)
    {
        $this->optionId = $optionId;
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
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @param boolean $required
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;
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
     * @param TranslationInterface $translation
     * @return $this
     */
    public function addTranslation(TranslationInterface $translation)
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
     * @return OptionGroupInterface
     */
    public function getOptionGroup()
    {
        return $this->optionGroup;
    }

    /**
     * @param OptionGroupInterface $optionGroup
     * @return $this
     */
    public function setOptionGroup(OptionGroupInterface $optionGroup)
    {
        $this->optionGroup = $optionGroup;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Option';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->optionId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->optionId = $id;
        return $this;
    }
}