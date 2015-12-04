<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class Webhook extends ResourceDependent implements WebhookInterface
{
    const FORMAT_JSON = 0;
    const FORMAT_XML = 1;

    const EVENT_ORDER_CREATE = 'order.create';
    const EVENT_ORDER_EDIT = 'order.edit';
    const EVENT_ORDER_PAID = 'order.paid';
    const EVENT_ORDER_STATUS = 'order.status';
    const EVENT_ORDER_DELETE = 'order.delete';

    const EVENT_CLIENT_CREATE = 'client.create';
    const EVENT_CLIENT_EDIT = 'client.edit';
    const EVENT_CLIENT_DELETE = 'client.delete';

    const EVENT_PRODUCT_CREATE = 'product.create';
    const EVENT_PRODUCT_EDIT = 'product.edit';
    const EVENT_PRODUCT_DELETE = 'product.delete';

    const EVENT_PARCEL_CREATE = 'parcel.create';
    const EVENT_PARCEL_DISPATCH = 'parcel.dispatch';
    const EVENT_PARCEL_DELETE = 'parcel.delete';

    const EVENT_SUBSCRIBER_CREATE = 'subscriber.create';
    const EVENT_SUBSCRIBER_EDIT = 'subscriber.edit';
    const EVENT_SUBSCRIBER_DELETE = 'subscriber.delete';

    /**
     * @var int
     */
    protected $webhookId;

    /**
     * @var array
     */
    protected $events;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var boolean
     */
    protected $active;

    /**
     * @var int
     */
    protected $format;

    /**
     * @return int
     */
    public function getWebhookId()
    {
        return $this->webhookId;
    }

    /**
     * @param int $webhookId
     * @return $this
     */
    public function setWebhookId($webhookId)
    {
        $this->webhookId = $webhookId;
        return $this;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param array $events
     * @return $this
     */
    public function setEvents($events)
    {
        $this->events = $events;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return int
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param int $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\Webhook';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->webhookId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->webhookId = $id;
        return $this;
    }
}