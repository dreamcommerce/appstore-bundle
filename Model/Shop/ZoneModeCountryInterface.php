<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface ZoneModeCountryInterface extends ZoneInterface
{
    /**
     * @return \ArrayAccess
     */
    public function getCountries();

    /**
     * @param GeolocationCountryInterface $country
     * @return $this
     */
    public function addCountry(GeolocationCountryInterface $country);

    /**
     * @param \ArrayAccess $countries
     * @return $this
     */
    public function setCountries($countries);
}