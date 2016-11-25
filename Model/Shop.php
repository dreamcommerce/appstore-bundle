<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Class Shop
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
abstract class Shop implements ShopInterface
{
    /**
     * shop identifier
     * @var string
     */
    protected $name;

    /**
     * shop URL
     * @var string
     */
    protected $shopUrl;

    /**
     * application name
     * @var string
     */
    protected $app;

    /**
     * billing entity handle
     * @var BillingInterface
     */
    protected $billing;

    /**
     * tokens
     * @var TokenInterface
     */
    protected $token;

    /**
     * paid subscriptions
     * @var SubscriptionInterface[]
     */
    protected $subscriptions;

    /**
     * version value
     * @var integer
     */
    protected $version;

    /**
     * is installed
     * @var bool
     */
    protected $installed;

    /**
     * @inheritdoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function setShopUrl($shopUrl)
    {
        $this->shopUrl = $shopUrl;
    }

    /**
     * @inheritdoc
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }

    /**
     * @inheritdoc
     */
    public function getToken(){
        return $this->token;
    }

    /**
     * @inheritdoc
     */
    public function setToken(TokenInterface $token){
        $this->token = $token;
    }

    /**
     * @inheritdoc
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @inheritdoc
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    /**
     * @inheritdoc
     */
    public function getBilling(){
        return $this->billing;
    }

    /**
     * @inheritdoc
     */
    public function setBilling(BillingInterface $billingInterface){
        $this->billing = $billingInterface;
    }

    /**
     * @inheritdoc
     */
    public function getSubscriptions(){
        return $this->subscriptions;
    }

    /**
     * @inheritdoc
     */
    public function addSubscription(SubscriptionInterface $subscription){
        $this->subscriptions[] = $subscription;
    }

    /**
     * @inheritdoc
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @inheritdoc
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * get installed
     * @return bool
     */
    public function getInstalled()
    {
        return $this->installed;
    }

    /**
     * set installed
     * @param bool $installed
     * @return void
     */
    public function setInstalled($installed)
    {
        $this->installed = $installed;
    }
}
