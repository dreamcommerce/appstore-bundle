<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Category extends ResourceDependent implements CategoryInterface
{
    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var boolean
     */
    protected $root;

    /**
     * @var int
     */
    protected $order;

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
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $categoryId
     * @return $this
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isRoot()
    {
        return $this->root;
    }

    /**
     * @param boolean $root
     * @return $this
     */
    public function setRoot($root)
    {
        $this->root = $root;
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
        return '\\DreamCommerce\\Resource\\Category';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->categoryId = $id;
        return $this;
    }
}