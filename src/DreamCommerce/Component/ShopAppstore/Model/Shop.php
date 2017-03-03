<?php

namespace DreamCommerce\Component\ShopAppstore\Model;




/**
 * Class Shop
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
class Shop implements ShopInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $settings;

    /**
     * @var
     */
    protected $register;

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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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

    /**
     * @return int
     */
    public function getSettings(): int
    {
        return $this->settings;
    }

    /**
     * @param int $settings
     */
    public function setSettings(int $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return mixed
     */
    public function getRegister()
    {
        return $this->register;
    }

    /**
     * @param mixed $register
     */
    public function setRegister($register)
    {
        $this->register = $register;
    }
}


