<?php


namespace DreamCommerce\ShopAppstoreBundle\Handler;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use Psr\Log\LoggerInterface;

class Application
{
    private $app;
    private $appId;
    private $appSecret;
    private $appstoreSecret;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct($app, $appId, $appSecret, $appstoreSecret, LoggerInterface $logger = null){
        $this->app = $app;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appstoreSecret = $appstoreSecret;
        $this->logger = $logger;
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

    /**
     * @param ShopInterface $shop
     * @return Client\OAuth
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function getClient(ShopInterface $shop)
    {
        $tokens = $shop->getToken();

        /**
         * @var $client Client\OAuth
         */
        $client = Client::factory(
            Client::ADAPTER_OAUTH,
            [
                'entrypoint'=>$shop->getShopUrl(),
                'client_id'=>$this->getAppId(),
                'client_secret'=>$this->getAppSecret()
            ]
        );

        $client->setAccessToken($tokens->getAccessToken());
        if($this->logger){
            $client->setLogger($this->logger);
        }

        return $client;
    }

}