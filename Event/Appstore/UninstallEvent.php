<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 11:52
 */

namespace DreamCommerce\ShopAppstoreBundle\Event\Appstore;


use DreamCommerce\ShopAppstoreBundle\Event\AppstoreEvent;

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