<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:32
 */

namespace DreamCommerce\ShopAppstoreBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class AppstoreEvent extends Event{

    /**
     * shop automatic message payload
     * @var array
     */
    protected $payload;
    /**
     * application name
     * @var string
     */
    protected $applicationName;

    /**
     * @param string $applicationName application name
     * @param array $application application config data
     * @param array $payload appstore payload
     */
    public function __construct($applicationName, $payload){
        $this->payload = $payload;
        $this->applicationName = $applicationName;
    }

    /**
     * get appstore packet
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * get application name
     * @return string
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

}