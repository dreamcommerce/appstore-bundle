<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Product extends ResourceDependent implements ProductInterface
{
    /**
     * @var int
     */
    protected $productId;

    /**
     * @var \DateTime
     */
    protected $addDate;

    /**
     * @var \DateTime
     */
    protected $editDate;

    /**
     * @var float
     */
    protected $otherPrice;

    /**
     * @var string
     */
    protected $pkwiu;

    /**
     * @var boolean
     */
    protected $isProductOfDay;

    /**
     * @var float
     * @since 5.7.0
     */
    protected $dimensionW;

    /**
     * @var float
     * @since 5.7.0
     */
    protected $dimensionH;

    /**
     * @var float
     * @since 5.7.0
     */
    protected $dimensionD;

    /**
     * @var CategoryInterface
     */
    protected $category;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    /**
     * @var \ArrayAccess
     */
    protected $images;

    /**
     * @var ProducerInterface
     */
    protected $producer;

    /**
     * @var TaxInterface
     */
    protected $tax;

    /**
     * @var UnitInterface
     */
    protected $unit;

    /**
     * @var ProductVoteInterface
     */
    protected $vote;

    /**
     * @var ProductSpecialOfferInterface
     */
    protected $specialOffer;

    /**
     * @var CurrencyInterface
     * @since 5.7.0
     */
    protected $currency;

    /**
     * @var \ArrayAccess
     */
    protected $attributes;

    /**
     * @var \ArrayAccess
     */
    protected $categories;

    /**
     * @var ProductStockInterface
     */
    protected $productStock;

    /**
     * @var \ArrayAccess
     */
    protected $optionsStock;

    /**
     * @var OptionGroupInterface
     */
    protected $optionGroup;

    /**
     * @var \ArrayAccess
     */
    protected $options;

    public function __construct()
    {
        $this->translations = new \ArrayObject();
        $this->images = new \ArrayObject();
        $this->attributes = new \ArrayObject();
        $this->categories = new \ArrayObject();
        $this->optionsStock = new \ArrayObject();
        $this->options = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getAddDate()
    {
        return $this->addDate;
    }

    /**
     * @param \DateTime|string $addDate
     * @return $this
     */
    public function setAddDate($addDate)
    {
        if(is_string($addDate)) {
            $addDate = new \DateTime($addDate);
        }

        $this->addDate = $addDate;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEditDate()
    {
        return $this->editDate;
    }

    /**
     * @param \DateTime|string $editDate
     * @return $this
     */
    public function setEditDate($editDate)
    {
        if(is_string($editDate)) {
            $editDate = new \DateTime($editDate);
        }

        $this->editDate = $editDate;
        return $this;
    }

    /**
     * @return float
     */
    public function getOtherPrice()
    {
        return $this->otherPrice;
    }

    /**
     * @param float $otherPrice
     * @return $this
     */
    public function setOtherPrice($otherPrice)
    {
        $this->otherPrice = $otherPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getPkwiu()
    {
        return $this->pkwiu;
    }

    /**
     * @param string $pkwiu
     * @return $this
     */
    public function setPkwiu($pkwiu)
    {
        $this->pkwiu = $pkwiu;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isIsProductOfDay()
    {
        return $this->isProductOfDay;
    }

    /**
     * @param boolean $isProductOfDay
     * @return $this
     */
    public function setIsProductOfDay($isProductOfDay)
    {
        $this->isProductOfDay = $isProductOfDay;
        return $this;
    }

    /**
     * @return float
     */
    public function getDimensionW()
    {
        return $this->dimensionW;
    }

    /**
     * @param float $dimensionW
     * @return $this
     */
    public function setDimensionW($dimensionW)
    {
        $this->dimensionW = $dimensionW;
        return $this;
    }

    /**
     * @return float
     */
    public function getDimensionH()
    {
        return $this->dimensionH;
    }

    /**
     * @param float $dimensionH
     * @return $this
     */
    public function setDimensionH($dimensionH)
    {
        $this->dimensionH = $dimensionH;
        return $this;
    }

    /**
     * @return float
     */
    public function getDimensionD()
    {
        return $this->dimensionD;
    }

    /**
     * @param float $dimensionD
     * @return $this
     */
    public function setDimensionD($dimensionD)
    {
        $this->dimensionD = $dimensionD;
        return $this;
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface $currency
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ProductImageInterface $image
     * @return $this
     */
    public function addImage(ProductImageInterface $image)
    {
        $this->images[] = $image;
        return $this;
    }

    /**
     * @param \ArrayAccess $images
     * @return $this
     */
    public function setImages(\ArrayAccess $images)
    {
        $this->images = $images;
        return $this;
    }

    /**
     * @return ProducerInterface
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * @param ProducerInterface $producer
     * @return $this
     */
    public function setProducer(ProducerInterface $producer)
    {
        $this->producer = $producer;
        return $this;
    }

    /**
     * @return TaxInterface
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param TaxInterface $tax
     * @return $this
     */
    public function setTax(TaxInterface $tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return UnitInterface
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param UnitInterface $unit
     * @return $this
     */
    public function setUnit(UnitInterface $unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * @return ProductVoteInterface
     */
    public function getVote()
    {
        return $this->vote;
    }

    /**
     * @param ProductVoteInterface $vote
     * @return $this
     */
    public function setVote(ProductVoteInterface $vote)
    {
        $this->vote = $vote;
        return $this;
    }

    /**
     * @return ProductSpecialOfferInterface
     */
    public function getSpecialOffer()
    {
        return $this->specialOffer;
    }

    /**
     * @param ProductSpecialOfferInterface $specialOffer
     * @return $this
     */
    public function setSpecialOffer(ProductSpecialOfferInterface $specialOffer)
    {
        $this->specialOffer = $specialOffer;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param AttributeInterface $attribute
     * @return $this
     */
    public function addAttribute(AttributeInterface $attribute)
    {
        $this->attributes[] = $attribute;
        return $this;
    }

    /**
     * @param \ArrayAccess $attributes
     * @return $this
     */
    public function setAttributes(\ArrayAccess $attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function addCategory(CategoryInterface $category)
    {
        $this->categories[] = $category;
        return $this;
    }

    /**
     * @param \ArrayAccess $categories
     * @return $this
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
        return $this;
    }

    /**
     * @return ProductStockInterface
     */
    public function getProductStock()
    {
        return $this->productStock;
    }

    /**
     * @param ProductStockInterface $productStock
     * @return $this
     */
    public function setProductStock(ProductStockInterface $productStock)
    {
        $this->productStock = $productStock;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptionsStock()
    {
        return $this->optionsStock;
    }

    public function addOptionStock(ProductStockInterface $productStock)
    {
        $this->optionsStock[] = $productStock;
    }

    /**
     * @param \ArrayAccess $optionsStock
     */
    public function setOptionsStock($optionsStock)
    {
        $this->optionsStock = $optionsStock;
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
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param CategoryInterface $category
     * @return $this
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param OptionInterface $option
     * @return $this
     */
    public function addOption(OptionInterface $option)
    {
        $this->options[] = $option;
        return $this;
    }

    /**
     * @param \ArrayAccess $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Product';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->productId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->productId = $id;
        return $this;
    }
}