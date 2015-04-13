<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 11:52
 */

namespace DreamCommerce\ShopAppstoreBundle\Event\Appstore;

use DreamCommerce\ShopAppstoreBundle\Event\AppstoreEvent;

class BillingInstallEvent extends AppstoreEvent{

    protected $application;
    protected $payload;
    protected $applicationName;

    public function __construct($applicationName, $application, $payload){
        $this->application = $application;
        $this->payload = $payload;
        $this->applicationName = $applicationName;
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
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