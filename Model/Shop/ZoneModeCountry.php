<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class ZoneModeCountry extends Zone implements ZoneModeCountryInterface
{
    /**
     * @var \ArrayAccess
     */
    protected $countries;

    public function __construct()
    {
        $this->countries = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return \ArrayAccess
     */
    public function getCountries()
    {
        return $this->countries;
    }

    /**
     * @param GeolocationCountryInterface $country
     * @return $this
     */
    public function addCountry(GeolocationCountryInterface $country)
    {
        $this->countries[] = $country;
        return $this;
    }

    /**
     * @param \ArrayAccess $countries
     * @return $this
     */
    public function setCountries($countries)
    {
        $this->countries = $countries;
        return $this;
    }
}