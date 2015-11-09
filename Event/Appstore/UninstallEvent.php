<?php
namespace DreamCommerce\ShopAppstoreBundle\Event\Appstore;


use DreamCommerce\ShopAppstoreBundle\Event\AppstoreEvent;

/**
 * Class UninstallEvent
 * @package DreamCommerce\ShopAppstoreBundle\Event\Appstore
 */
class UninstallEvent extends AppstoreEvent{

    /**
     * @var
     */
    protected $applicationName;
    /**
     * @var
     */
    protected $payload;

    public function __construct($applicationName, $payload){

        $this->applicationName = $applicationName;
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

}