<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

//todo: multiple applications database structure
abstract class Shop implements ShopInterface
{
    protected $name;

    protected $shopUrl;

    protected $app;

    protected $billing;

    protected $token;

    protected $subscriptions;

    public function __construct(){
        $this->subscriptions = new ArrayCollection();
    }


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
}
