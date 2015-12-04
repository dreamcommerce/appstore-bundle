<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ZoneModeRegionInterface extends ZoneInterface
{
    /**
     * @return GeolocationCountryInterface
     */
    public function getCountry();

    /**
     * @param GeolocationCountryInterface $country
     * @return $this
     */
    public function setCountry(GeolocationCountryInterface $country);

    /**
     * @return \ArrayAccess
     */
    public function getRegions();

    /**
     * @param GeolocationRegionInterface $region
     * @return $this
     */
    public function addRegion(GeolocationRegionInterface $region);

    /**
     * @param \ArrayAccess $regions
     * @return $this
     */
    public function setRegions($regions);
}