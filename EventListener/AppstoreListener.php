<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:18
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use BillingBundle\Entity\Billing;
use BillingBundle\Entity\Subscription;
use DreamCommerce\Client;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\ShopAppstoreBundle\EntityManager\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\EntityManager\TokenManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\ShopAppstoreBundle\EntityManager\BillingManagerInterface;
use DreamCommerce\ShopAppstoreBundle\EntityManager\SubscriptionManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;

class AppstoreListener implements ActionListenerInterface{

    protected $shopManager;
    protected $tokenManager;
    /**
     * @var BillingManagerInterface
     */
    protected $billingManager;
    /**
     * @var SubscriptionManagerInterface
     */
    protected $subscriptionManager;

    public function __construct(ShopManagerInterface $shopManager, TokenManagerInterface $tokenManager, BillingManagerInterface $billingManager, SubscriptionManagerInterface $subscriptionManager){
        $this->shopManager = $shopManager;
        $this->tokenManager = $tokenManager;
        $this->billingManager = $billingManager;
        $this->subscriptionManager = $subscriptionManager;
    }

    public function onInstall(InstallEvent $event){

        $params = $event->getPayload();
        $app = $event->getApplication();

        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        $shop = $this->shopManager->findShopByNameAndApplication($shopName, $appName);

        if($shop){
            return false;
        }

        try {
            $client = new Client($params['shop_url'], $app['app_id'], $app['app_secret']);
            $token = $client->getToken($params['auth_code']);
        }catch(ClientException $ex){
            return false;
        }

        $shopModel = $this->shopManager->create();
        $shopModel->setApp($appName);
        $shopModel->setName($shopName);
        $shopModel->setShopUrl($params['shop_url']);
        $shopModel->setVersion($params['application_version']);
        $this->shopManager->save($shopModel);

        $tokenModel = $this->tokenManager->create();
        $tokenModel->setAccessToken($token['access_token']);
        $tokenModel->setRefreshToken($token['refresh_token']);

        $expiresAt = new \DateTime();
        $expiresAt->add(\DateInterval::createFromDateString($token['expires_in'].' seconds'));
        $tokenModel->setExpiresAt($expiresAt);
        $tokenModel->setShop($shopModel);
        $this->tokenManager->save($tokenModel);

    }

    public function onUninstall(UninstallEvent $event){

        //todo: refactor ctrl+c, ctrl+v code
        $params = $event->getPayload();

        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        $shop = $this->shopManager->findShopByNameAndApplication($shopName, $appName);

        if(!$shop){
            return false;
        }

        $this->shopManager->delete($shop);
    }

    public function onPaid(BillingInstallEvent $event){

        //todo: refactor ctrl+c, ctrl+v code
        $params = $event->getPayload();
        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        $shop = $this->shopManager->findShopByNameAndApplication($shopName, $appName);

        if(!$shop){
            return false;
        }

        // todo: class creation from manager
        $billing = new Billing();
        $billing->setShop($shop);

        $this->billingManager->save($billing);
    }

    public function onSubscribed(SubscriptionEvent $event){

        //todo: refactor ctrl+c, ctrl+v code
        $params = $event->getPayload();
        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        $shop = $this->shopManager->findShopByNameAndApplication($shopName, $appName);

        //todo: event getExpiresAt value as method

        if(!$shop){
            return false;
        }

        // todo: class creation from manager
        $subscription = new Subscription();

        $expiresAt = new \DateTime($params['subscription_end_time']);

        $subscription->setExpiresAt($expiresAt);
        $subscription->setShop($shop);

        $this->subscriptionManager->save($subscription);

    }

    public function onUpgraded(UpgradeEvent $event){
        //todo: refactor ctrl+c, ctrl+v code
        $params = $event->getPayload();
        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        $shop = $this->shopManager->findShopByNameAndApplication($shopName, $appName);

        if(!$shop){
            return false;
        }

        $shop->setVersion($params['application_version']);
    }

}