<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class GeolocationCountry extends ResourceDependent implements GeolocationCountryInterface
{
    /**
     * @var int
     */
    protected $countryId;

    /**
     * @var boolean
     */
    protected $regions;

    /**
     * @var boolean
     */
    protected $codes;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;
    }

    /**
     * @return boolean
     */
    public function isRegions()
    {
        return $this->regions;
    }

    /**
     * @param boolean $regions
     */
    public function setRegions($regions)
    {
        $this->regions = $regions;
    }

    /**
     * @return boolean
     */
    public function isCodes()
    {
        return $this->codes;
    }

    /**
     * @param boolean $codes
     */
    public function setCodes($codes)
    {
        $this->codes = $codes;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
}