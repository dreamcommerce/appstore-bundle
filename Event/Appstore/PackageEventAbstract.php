<?php


namespace DreamCommerce\ShopAppstoreBundle\Event\Appstore;


class PackageEventAbstract extends EventAbstract
{
    /**
     * application data
     * @var array
     */
    protected $application;

    /**
     * @param string $applicationName application name
     * @param array $application application config data
     * @param array $payload appstore payload
     */
    public function __construct($applicationName, $application, $payload){
        $this->application = $application;
        parent::__construct($applicationName, $payload);
    }

    /**
     * get application config data
     * @return array
     */
    public function getApplication()
    {
        return $this->application;
    }

}