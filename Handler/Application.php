<?php


namespace DreamCommerce\ShopAppstoreBundle\Handler;


use DreamCommerce\Client;
use DreamCommerce\ClientInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Application
 * @package DreamCommerce\ShopAppstoreBundle\Handler
 */
class Application
{
    /**
     * application name
     * @var string
     */
    protected $app;
    /**
     * application identifier
     * @var string
     */
    protected $appId;
    /**
     * app secret
     * @var string
     */
    protected $appSecret;
    /**
     * appstore secret
     * @var string
     */
    protected $appstoreSecret;
    /**
     * logger handler
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param string $app app name
     * @param string $appId application ID
     * @param string $appSecret app secret
     * @param string $appstoreSecret appstore secret
     * @param LoggerInterface|null $logger if not null, logger used to pass ShopAppstoreLib debug information
     */
    public function __construct($app, $appId, $appSecret, $appstoreSecret, LoggerInterface $logger = null){
        $this->app = $app;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appstoreSecret = $appstoreSecret;
        $this->logger = $logger;
    }

    /**
     * get application name
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * get application ID
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * get app secret
     * @return mixed
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * get appstore secret
     * @return mixed
     */
    public function getAppstoreSecret()
    {
        return $this->appstoreSecret;
    }

    /**
     * get ShopAppstoreLib client
     * @param ShopInterface $shop
     * @return ClientInterface
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