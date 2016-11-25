<?php
namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreBundle\Utils\ShopChecker;
use DreamCommerce\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\ShopAppstoreBundle\Utils\TokenRefresher;
use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\Client\Exception\Exception;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\EventAbstract;
use DreamCommerce\ShopAppstoreBundle\Model\BillingInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopRepositoryInterface;
use DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface;
use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;

class AppstoreListener{
    /**
     * @var ObjectManagerInterface
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
     * @param ObjectManagerInterface $objectManager
     * @param $skipSsl
     * @param TokenRefresher $tokenRefresher
     */
    public function __construct(ObjectManagerInterface $objectManager, $skipSsl, TokenRefresher $tokenRefresher){
        $this->objectManager = $objectManager;
        $this->skipSsl = $skipSsl;
        $this->tokenRefresher = $tokenRefresher;
    }

    /**
     * get shop by particular event
     * @param EventAbstract $event
     * @return \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface
     */
    protected function getShopByEvent(EventAbstract $event){
        $params = $event->getPayload();

        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        /**
         * @var $repo ShopRepositoryInterface
         */
        $repo = $this->objectManager->getRepository('DreamCommerce\ShopAppstoreBundle\Model\ShopInterface');
        return $repo->findOneByNameAndApplication($shopName, $appName);
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

            $params = $event->getPayload();
            $app = $event->getApplication();

            $url = $shopChecker->getRealShopUrl($params['shop_url']);
            if(!$url){
                $url = $params['shop_url'];
                //throw new Exception($url.' - Cannot determine real URL for: '.$params['shop_url']);
            }

            // perform client instantiation
            $client = Client::factory(
                Client::ADAPTER_OAUTH,
                [
                    'entrypoint'=>$url,
                    'client_id'=>$app['app_id'],
                    'client_secret'=>$app['app_secret'],
                    'auth_code'=>$params['auth_code'],
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
            $shopModel = $this->objectManager->create('DreamCommerce\ShopAppstoreBundle\Model\ShopInterface');
        }
        $shopModel->setApp($event->getApplicationName());
        $shopModel->setName($params['shop']);
        $shopModel->setShopUrl($url);
        $shopModel->setVersion($params['application_version']);
        $shopModel->setInstalled(true);
        $this->objectManager->save($shopModel, false);
        // endregion

        // region token
        if ($update) {
            $tokenModel = $shop->getToken();
        } else {
            /** @var $tokenModel TokenInterface */
            $tokenModel = $this->objectManager->create('DreamCommerce\ShopAppstoreBundle\Model\TokenInterface');
        }

        $tokenModel->setAccessToken($token['access_token']);
        $tokenModel->setRefreshToken($token['refresh_token']);

        $expiresAt = new \DateTime();
        $expiresAt->add(\DateInterval::createFromDateString($token['expires_in'].' seconds'));

        $tokenModel->setExpiresAt($expiresAt);
        $tokenModel->setShop($shopModel);

        $this->objectManager->save($tokenModel);
        // endregion

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
        $this->objectManager->save($shop);
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
        $billing = $this->objectManager->create('DreamCommerce\ShopAppstoreBundle\Model\BillingInterface');
        $billing->setShop($shop);

        $this->objectManager->save($billing);
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
        $subscription = $this->objectManager->create('DreamCommerce\ShopAppstoreBundle\Model\SubscriptionInterface');

        // convert date string to an object
        $expiresAt = new \DateTime($event->getPayload()['subscription_end_time']);

        $subscription->setExpiresAt($expiresAt);
        $subscription->setShop($shop);

        $this->objectManager->save($subscription);

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

        $shop->setVersion($event->getPayload()['application_version']);
        $this->objectManager->save($shop);
    }

}