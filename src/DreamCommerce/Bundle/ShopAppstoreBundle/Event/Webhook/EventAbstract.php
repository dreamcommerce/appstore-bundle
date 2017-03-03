<?php

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Event\Webhook;

use DreamCommerce\Bundle\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use Symfony\Component\EventDispatcher\Event;

class EventAbstract extends Event
{

    /**
     * @var
     */
    protected $payload;
    /**
     * @var ShopInterface
     */
    protected $shop;
    /**
     * @var Application
     */
    protected $application;

    public function __construct($payload, ShopInterface $shop = null, Application $application = null)
    {
        $this->payload = $payload;
        $this->shop = $shop;
        $this->application = $application;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getShop()
    {
        return $this->shop;
    }

    public function getApplication()
    {
        return $this->application;
    }

}