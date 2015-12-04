<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Tax extends ResourceDependent implements TaxInterface
{
    /**
     * @var int
     */
    protected $taxId;

    /**
     * @var double
     */
    protected $value;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \ArrayAccess
     */
    protected $products;

    public function __construct()
    {
        $this->products = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getTaxId()
    {
        return $this->taxId;
    }

    /**
     * @param int $taxId
     * @return $this
     */
    public function setTaxId($taxId)
    {
        $this->taxId = $taxId;
        return $this;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * @param ProductInterface $product
     * @return $this
     */
    public function addProduct(ProductInterface $product)
    {
        $this->products[] = $product;
        return $this;
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
        return '\\DreamCommerce\\Resource\\Tax';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->taxId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->taxId = $id;
        return $this;
    }
}