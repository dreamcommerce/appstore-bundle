<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Gauge extends ResourceDependent implements GaugeInterface
{
    /**
     * @var int
     */
    protected $gaugeId;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $shippings;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->shippings = new \ArrayObject();
        $this->products = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getGaugeId()
    {
        return $this->gaugeId;
    }

    /**
     * @param int $gaugeId
     * @return $this
     */
    public function setGaugeId($gaugeId)
    {
        $this->gaugeId = $gaugeId;
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
    public function getShippings()
    {
        return $this->shippings;
    }

    /**
     * @param ShippingInterface $shipping
     * @return $this
     */
    public function addShipping(ShippingInterface $shipping)
    {
        $this->shippings[] = $shipping;
    }

    /**
     * @param \ArrayAccess $shippings
     * @return $this
     */
    public function setShippings($shippings)
    {
        $this->shippings = $shippings;
    }

    /**
     * @return \ArrayAccess
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
    }

    /**
     * @param \ArrayAccess $products
     * @return $this
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Gauge';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->gaugeId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->gaugeId = $id;
        return $this;
    }
}