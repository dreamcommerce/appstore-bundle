<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Delivery extends ResourceDependent implements DeliveryInterface
{
    /**
     * @var int
     */
    protected $deliveryId;

    /**
     * @var float
     */
    protected $days;

    /**
     * @var \ArrayAccess
     */
    protected $translations;

    public function __construct()
    {
        $this->translations = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getDeliveryId()
    {
        return $this->deliveryId;
    }

    /**
     * @param int $deliveryId
     * @return $this
     */
    public function setDeliveryId($deliveryId)
    {
        $this->deliveryId = $deliveryId;
        return $this;
    }

    /**
     * @return float
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param float $days
     * @return $this
     */
    public function setDays($days)
    {
        $this->days = $days;
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
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Delivery';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->deliveryId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->deliveryId = $id;
        return $this;
    }
}