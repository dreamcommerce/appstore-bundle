<?php

namespace DreamCommerce\ShopAppstoreBundle\Event\Webhook;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
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

    public function __construct($payload, ShopInterface $shop = null)
    {
        $this->payload = $payload;
        $this->shop = $shop;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function getShop()
    {
        return $this->shop;
    }

}