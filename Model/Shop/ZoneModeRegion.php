<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class ZoneModeRegion extends Zone implements ZoneModeRegionInterface
{
    /**
     * @var GeolocationCountryInterface
     */
    protected $country;

    /**
     * @var \ArrayAccess
     */
    protected $regions;

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
    public function setCountry(GeolocationCountryInterface $country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getRegions()
    {
        return $this->regions;
    }

    /**
     * @param GeolocationRegionInterface $region
     * @return $this
     */
    public function addRegion(GeolocationRegionInterface $region)
    {
        $this->regions[] = $region;
        return $this;
    }

    /**
     * @param \ArrayAccess $regions
     * @return $this
     */
    public function setRegions($regions)
    {
        $this->regions = $regions;
        return $this;
    }
}