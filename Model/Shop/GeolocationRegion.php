<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class GeolocationRegion extends ResourceDependent implements GeolocationRegionInterface
{
    /**
     * @var int
     */
    protected $regionId;

    /**
     * @var string
     */
    protected $isocode;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var GeolocationCountryInterface
     */
    protected $country;

    /**
     * @return int
     */
    public function getRegionId()
    {
        return $this->regionId;
    }

    /**
     * @param int $regionId
     * @return $this
     */
    public function setRegionId($regionId)
    {
        $this->regionId = $regionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * @param string $isocode
     * @return $this
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;
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
     * @return GeolocationCountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param GeolocationCountryInterface $country
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
}