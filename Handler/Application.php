<?php


namespace DreamCommerce\ShopAppstoreBundle\Handler;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

class Application
{
    private $app;
    private $appId;
    private $appSecret;
    private $appstoreSecret;

    public function __construct($app, $appId, $appSecret, $appstoreSecret){

        $this->app = $app;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appstoreSecret = $appstoreSecret;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * @return mixed
     */
    public function getAppstoreSecret()
    {
        return $this->appstoreSecret;
    }

    public function getClient(ShopInterface $shop)
    {
        $tokens = $shop->getToken();

        $client = new Client($shop->getShopUrl(), $this->getAppId(), $this->getAppSecret());
        $client->setAccessToken($tokens->getAccessToken());

        return $client;
    }

}