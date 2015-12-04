<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

abstract class Zone extends ResourceDependent implements ZoneInterface
{
    /**
     * @var int
     */
    protected $zoneId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $mode;

    /**
     * @return int
     */
    public function getZoneId()
    {
        return $this->zoneId;
    }

    /**
     * @param int $zoneId
     * @return $this
     */
    public function setZoneId($zoneId)
    {
        $this->zoneId = $zoneId;
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
     * @return int
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param int $mode
     * @return $this
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }
}