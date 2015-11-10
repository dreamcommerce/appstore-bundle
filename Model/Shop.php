<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Shop implements ShopInterface
{
    protected $name;

    protected $shopUrl;

    protected $app;

    protected $billing;

    protected $token;

    protected $subscriptions;

    protected $version;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setShopUrl($shopUrl)
    {
        $this->shopUrl = $shopUrl;

        return $this;
    }

    public function getShopUrl()
    {
        return $this->shopUrl;
    }

    public function getToken(){
        return $this->token;
    }

    public function setToken(TokenInterface $token){
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    public function getBilling(){
        return $this->billing;
    }

    public function setBilling(BillingInterface $billingInterface){
        $this->billing = $billingInterface;
    }

    public function getSubscriptions(){
        return $this->subscriptions;
    }

    public function addSubscription(SubscriptionInterface $subscription){
        $this->subscriptions[] = $subscription;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}
