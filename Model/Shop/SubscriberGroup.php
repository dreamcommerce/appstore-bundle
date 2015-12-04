<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

class SubscriberGroup extends ResourceDependent implements SubscriberGroupInterface
{
    /**
     * @var int
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var boolean
     */
    protected $autoAdd;

    /**
     * @var \ArrayAccess
     */
    protected $subscribers;

    public function __construct()
    {
        $this->subscribers = new \ArrayObject();

        parent::__construct();
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return $this
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAutoAdd()
    {
        return $this->autoAdd;
    }

    /**
     * @param boolean $autoAdd
     * @return $this
     */
    public function setAutoAdd($autoAdd)
    {
        $this->autoAdd = $autoAdd;
        return $this;
    }

    /**
     * @return \ArrayAccess
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param SubscriberInterface $subscriber
     * @return $this
     */
    public function addSubscriber(SubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
        return $this;
    }

    /**
     * @param \ArrayAccess $subscribers
     * @return $this
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
        return $this;
    }

    /**
     * @return string
     */
    public function getResourceClassName()
    {
        return '\\DreamCommerce\\Resource\\SubscriberGroup';
    }

    /**
     * @return int
     */
    public function getResourceId()
    {
        return $this->groupId;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setResourceId($id)
    {
        $this->groupId = $id;
        return $this;
    }
}