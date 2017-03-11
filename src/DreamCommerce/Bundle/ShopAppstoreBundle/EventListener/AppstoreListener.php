<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\EventListener;


use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\ShopChecker;
use DreamCommerce\Bundle\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\TokenRefresher;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;
use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValueInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValueString;
use DreamCommerce\Component\ShopAppstore\Model\ShopHashGenerator\ShopHashGenerator;
use DreamCommerce\Component\ShopAppstore\Repository\MetafieldRepository;
use DreamCommerce\Component\ShopAppstore\Services\ResourceService;
use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\Client\Exception\Exception;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\EventAbstract;
use DreamCommerce\Component\ShopAppstore\Model\BillingInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopRepositoryInterface;
use DreamCommerce\Component\ShopAppstore\Model\SubscriptionInterface;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use Monolog\Logger;
use Sylius\Component\Resource\Factory\Factory;

class AppstoreListener{
    /**
     * @var ObjectManager
     */
    protected $objectManager;
    /**
     * @var bool
     */
    protected $skipSsl;
    /**
     * @var TokenRefresher
     */
    protected $tokenRefresher;

    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    /**
     * @var ResourceService
     */
    protected $resourceService;

    /**
     * @var MetafieldRepository
     */
    protected $metafieldRepository;

    /**
     * @var Factory
     */
    protected $shopFactory;

    /**
     * @var Factory
     */
    protected $tokenFactory;

    /**
     * @var Factory
     */
    protected $billingFactory;

    /**
     * @var Factory
     */
    protected $subscriptionFactory;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ShopHashGenerator
     */
    protected $shopHashGenerator;

    /**
     * @var Factory
     */
    protected $metafieldFactory;

    /**
     * @var string
     */
    protected $applicationNamespace;

    /**
     * @param ObjectManager $objectManager
     * @param $skipSsl
     * @param TokenRefresher $tokenRefresher
     */
    public function __construct(ObjectManager $objectManager, $skipSsl, TokenRefresher $tokenRefresher, Logger $logger){
        $this->objectManager = $objectManager;
        $this->skipSsl = $skipSsl;
        $this->tokenRefresher = $tokenRefresher;
        $this->logger = $logger;
    }

    /**
     * @param ShopRepositoryInterface $shopRepository
     */
    public function setRepositories(
        ShopRepositoryInterface $shopRepository,
        MetafieldRepository $metafieldRepository
    )
    {
        $this->shopRepository = $shopRepository;
        $this->metafieldRepository = $metafieldRepository;
    }

    /**
     * @param Factory $shopFactory
     * @param Factory $tokenFactory
     * @param Factory $billingFactory
     * @param Factory $subscriptionFactory
     * @param Factory $metafieldFactory
     */
    public function setFactories(
        Factory $shopFactory,
        Factory $tokenFactory,
        Factory $billingFactory,
        Factory $subscriptionFactory,
        Factory $metafieldFactory
    )
    {
        $this->shopFactory          = $shopFactory;
        $this->tokenFactory         = $tokenFactory;
        $this->billingFactory       = $billingFactory;
        $this->subscriptionFactory  = $subscriptionFactory;
        $this->metafieldFactory     = $metafieldFactory;
    }

    public function setResourceService(ResourceService $resourceService) {
        $this->resourceService = $resourceService;
    }

    public function setShopHashGenerator(ShopHashGenerator $generator) {
        $this->shopHashGenerator = $generator;
    }

    public function setApplicationNamespace(string $namespace)
    {
        $this->applicationNamespace = $namespace;
    }

    /**
     * get shop by particular event
     * @param EventAbstract $event
     * @return \DreamCommerce\Component\ShopAppstore\Model\ShopInterface
     */
    protected function getShopByEvent(EventAbstract $event){
        $params = $event->getPayload();

        $appName = $event->getApplicationName();
        $shopName = $params->getShop();

        /**
         * @var $repo ShopRepositoryInterface
         */
        return $this->shopRepository->findOneByNameAndApplication($shopName, $appName);
    }

    /**
     * handle installation event
     * @param InstallEvent $event
     * @return bool
     * @throws Exception
     */
    public function onInstall(InstallEvent $event){

        // extract shop entity from event
        $shop = $this->getShopByEvent($event);
        $update = false;
        // already installed, skip
        if($shop){
            if ($shop->getInstalled()) {
                return false;
            } else {
                $update = true;
            }
        }

        $shopChecker = new ShopChecker();

        try {
            $params = $event->getApplicationPayload();
            $app = $event->getApplication();

            $url = $shopChecker->getRealShopUrl($params->getShopUrl());
            if(!$url){
                $url = $params->getShopUrl();
                //throw new Exception($url.' - Cannot determine real URL for: '.$params['shop_url']);
            }

            // perform client instantiation
            $client = Client::factory(
                Client::ADAPTER_OAUTH,
                [
                    'entrypoint'=>$url,
                    'client_id'=>$app['app_id'],
                    'client_secret'=>$app['app_secret'],
                    'auth_code'=>$params->getAuthCode(),
                    'skip_ssl'=>$this->skipSsl,
                    'user_agent'=>$app['user_agent']
                ]
            );

            // and get tokens
            $token = $client->authenticate(true);
        }catch(Exception $ex){
            // allow error to be logged
            throw $ex;
        }

        // region shop

        if ($update) {
            $shopModel = $shop;
        } else {
            /**
             * @var $shopModel ShopInterface
             */
            $shopModel = $this->shopFactory->createNew();
        }


        $shopModel->setApp($event->getApplicationName());
        $shopModel->setName($params->getShop());
        $shopModel->setShopUrl($url);
        $shopModel->setVersion($params->getApplicationVersion());
        $shopModel->setInstalled(true);
        $shopModel->setHash($this->shopHashGenerator->generate($params));
        $this->objectManager->persist($shopModel);

        if ($update) {
            $tokenModel = $shop->getToken();
        } else {
            /** @var $tokenModel TokenInterface */
            $tokenModel = $this->tokenFactory->createNew();
        }

        $tokenModel->setAccessToken($token['access_token']);
        $tokenModel->setRefreshToken($token['refresh_token']);

        $expiresAt = new \DateTime();
        $expiresAt->add(\DateInterval::createFromDateString($token['expires_in'].' seconds'));

        $tokenModel->setExpiresAt($expiresAt);
        $tokenModel->setShop($shopModel);

        $this->objectManager->persist($tokenModel);
        $this->objectManager->flush();

        $this->insertMetafields($client, $shopModel);
    }

    private function insertMetafields(Client\OAuth $client, ShopInterface $shop)
    {
        /** @var Metafield $metafield */
        $metafield = $this->metafieldFactory->createNew();
        $metafield->setType(MetafieldValueInterface::TYPE_STRING);
        $metafield->setShop($shop);
        $metafield->setDescription('');
        $metafield->setMetafieldKey('shop_hash', $shop->getHash());
        $metafield->setNamespace($this->applicationNamespace);
        $metafield->setObject(MetafieldInterface::OBJECT_SYSTEM);

        $metafieldValue = new MetafieldValueString();
        $metafieldValue->setMetafield($metafield);
        $metafieldValue->setExternalObjectId(0);
        $metafieldValue->setValue($shop->getHash());

        $this->resourceService->insertMetafield($client, $metafield);
        $this->resourceService->insertMetafieldValue($client, $metafieldValue);

        $this->objectManager->persist($metafield);
        $this->objectManager->persist($metafieldValue);
        $this->objectManager->flush();
    }

    /**
     * uninstall shop from application
     * @param UninstallEvent $event
     * @return bool
     */
    public function onUninstall(UninstallEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop || !$shop->getInstalled()){
            return false;
        }

        $shop->setInstalled(false);
        $this->objectManager->persist($shop);
        $this->objectManager->flush();


        $this->metafieldRepository->removeByShop($shop);
    }

    /**
     * application installation got paid
     * @param BillingInstallEvent $event
     * @return bool
     */
    public function onPay(BillingInstallEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop || !$shop->getInstalled()){
            return false;
        }

        /**
         * @var $billing BillingInterface
         */
        $billing = $this->billingFactory->createNew();
        $billing->setShop($shop);

        $this->objectManager->persist($billing);
        $this->objectManager->flush();
    }

    /**
     * application subscription got paid
     * @param SubscriptionEvent $event
     * @return bool
     */
    public function onSubscribe(SubscriptionEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop || !$shop->getInstalled()){
            return false;
        }

        /**
         * @var $subscription SubscriptionInterface
         */
        $subscription = $this->subscriptionFactory->createNew();

        // convert date string to an object
        $expiresAt = new \DateTime($event->getPayload()->getSubscriptionEndTime());

        $subscription->setExpiresAt($expiresAt);
        $subscription->setShop($shop);

        $this->objectManager->persist($subscription);
        $this->objectManager->flush();
    }

    /**
     * shop installed an upgraded version
     * @param UpgradeEvent $event
     * @return bool
     */
    public function onUpgrade(UpgradeEvent $event){
        $shop = $this->getShopByEvent($event);

        if(!$shop || !$shop->getInstalled()){
            return false;
        }

        // todo: refactor this on major change: push application object thru event
        $appData = $event->getApplication();

        $app = new Application(
            $event->getApplicationName(),
            $appData['app_id'],
            $appData['app_secret'],
            $appData['appstore_secret'],
            null,
            $this->skipSsl
        );

        $app->setUserAgent($appData['user_agent']);

        $this->tokenRefresher->setClient($app->getClient($shop));
        $this->tokenRefresher->refresh($shop);

        $shop->setVersion($event->getPayload()->getApplicationVersion());
        $this->objectManager->persist($shop);
        $this->objectManager->flush();
    }
}