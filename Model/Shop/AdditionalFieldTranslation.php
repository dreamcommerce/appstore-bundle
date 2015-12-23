<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class AdditionalFieldTranslation implements AdditionalFieldTranslationInterface
{
    /**
     * @var int
     */
    protected $translationId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var LanguageInterface
     */
    protected $language;

    /**
     * @var AdditionalFieldInterface
     */
    protected $additionalField;

    /**
     * @return int
     */
    public function getTranslationId()
    {
        return $this->translationId;
    }

    /**
     * @param int $translationId
     * @return $this
     */
    public function setTranslationId($translationId)
    {
        $this->translationId = $translationId;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return LanguageInterface
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param LanguageInterface $language
     * @return $this
     */
    public function setLanguage(LanguageInterface $language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return AdditionalFieldInterface
     */
    public function getAdditionalField()
    {
        return $this->additionalField;
    }

    /**
     * @param AdditionalFieldInterface $additionalField
     * @return $this
     */
    public function setAdditionalField(AdditionalFieldInterface $additionalField)
    {
        $this->additionalField = $additionalField;
        return $this;
    }
}