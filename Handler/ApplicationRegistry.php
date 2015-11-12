<?php


namespace DreamCommerce\ShopAppstoreBundle\Handler;


class ApplicationRegistry
{

    protected $apps = [];

    public function register(Application $application)
    {
        $this->apps[$application->getApp()] = $application;
    }

    /**
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