<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Handler;


use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Application
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Handler
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
     * skip SSL validation
     * @var bool
     */
    protected $skipSsl;
    /**
     * @var null|integer
     */
    protected $minimalVersion;
    /**
     * @var null|string
     */
    protected $userAgent;
    /**
     * webhooks definition list
     * @var []
     */
    protected $webhooks;

    /**
     * @param string $app app name
     * @param string $appId application ID
     * @param string $appSecret app secret
     * @param string $appstoreSecret appstore secret
     * @param LoggerInterface|null $logger if not null, logger used to pass ShopAppstoreLib debug information
     * @param bool $skipSsl
     */
    public function __construct($app, $appId, $appSecret, $appstoreSecret, LoggerInterface $logger = null, $skipSsl = false, $minimalVersion = null){
        $this->app = $app;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appstoreSecret = $appstoreSecret;
        $this->logger = $logger;
        $this->skipSsl = $skipSsl;
        $this->minimalVersion = $minimalVersion;
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
     * @throws \DreamCommerce\ShopAppstoreLib\Exception\ClientException
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
                'client_secret'=>$this->getAppSecret(),
                'skip_ssl'=>$this->skipSsl,
                'user_agent'=>$this->getUserAgent()
            ]
        );

        $client->setAccessToken($tokens->getAccessToken());
        if($this->logger){
            $client->setLogger($this->logger);
        }

        return $client;
    }

    /**
     * @return int|null
     */
    public function getMinimalVersion()
    {
        return $this->minimalVersion;
    }

    /**
     * @return null|string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param null|string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @param string|null $webhook name to get or return all
     * @return null|[]
     */
    public function getWebhook($webhook = null)
    {
        if($webhook){
            if(isset($this->webhooks[$webhook])){
                return $this->webhooks[$webhook];
            }else{
                return null;
            }
        }
        return $this->webhooks;
    }

    /**
     * @param [] $webhooks
     */
    public function setWebhooks($webhooks)
    {
        $this->webhooks = $webhooks;
    }

}