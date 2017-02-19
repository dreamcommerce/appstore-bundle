<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Handler;

/**
 * Class ApplicationRegistry
 *
 * registry of applications
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Handler
 */
class ApplicationRegistry
{

    /**
     * @var Application[]
     */
    protected $apps = [];

    /**
     * registers instantiated application in registry
     * @param Application $application
     */
    public function register(Application $application)
    {
        $this->apps[$application->getApp()] = $application;
    }

    /**
     * get an application from registry
     * @param $application
     * @return Application|null
     */
    public function get($application)
    {
        if(isset($this->apps[$application])){
            return $this->apps[$application];
        }

        return null;
    }

}