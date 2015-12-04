<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Unit extends ResourceDependent implements UnitInterface
{
    /**
     * @var int
     */
    protected $unitId;

    /**
     * @var boolean
     */
    protected $floatingPoint;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->products = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getUnitId()
    {
        return $this->unitId;
    }

    /**
     * @param int $unitId
     * @return $this
     */
    public function setUnitId($unitId)
    {
        $this->unitId = $unitId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isFloatingPoint()
    {
        return $this->floatingPoint;
    }

    /**
     * @param boolean $floatingPoint
     * @return $this
     */
    public function setFloatingPoint($floatingPoint)
    {
        $this->floatingPoint = $floatingPoint;
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
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Unit';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->unitId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->unitId = $id;
        return $this;
    }
}