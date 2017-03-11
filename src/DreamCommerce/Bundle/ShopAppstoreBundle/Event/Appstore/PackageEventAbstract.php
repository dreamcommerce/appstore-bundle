<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore;


use DreamCommerce\Component\ShopAppstore\Model\Application;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;

class PackageEventAbstract extends EventAbstract
{
    /**
     * application data
     * @var array
     */
    protected $application;

    /**
     * @var ApplicationPayloadInterface
     */
    protected $applicationPayload;

    /**
     * @param string $applicationName application name
     * @param array $application application config data
     * @param array $payload appstore payload
     */
    public function __construct($applicationName, $application, ApplicationPayload $payload){
        $this->application          = $application;
        $this->applicationPayload   = $payload;

        parent::__construct($applicationName, $payload);
    }

    public function getApplicationPayload(): ApplicationPayload
    {
        return $this->applicationPayload;
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