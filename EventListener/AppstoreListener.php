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
use DreamCommerce\ShopAppstoreBundle\Event\AppstoreEvent;

class AppstoreListener implements ActionListenerInterface{

    /**
     * @var ShopManagerInterface
     */
    protected $shopManager;
    /**
     * @var TokenManagerInterface
     */
    protected $tokenManager;
    /**
     * @var BillingManagerInterface
     */
    protected $billingManager;
    /**
     * @var SubscriptionManagerInterface
     */
    protected $subscriptionManager;

    /**
     * @param ShopManagerInterface $shopManager
     * @param TokenManagerInterface $tokenManager
     * @param BillingManagerInterface $billingManager
     * @param SubscriptionManagerInterface $subscriptionManager
     */
    public function __construct(ShopManagerInterface $shopManager, TokenManagerInterface $tokenManager, BillingManagerInterface $billingManager, SubscriptionManagerInterface $subscriptionManager){
        $this->shopManager = $shopManager;
        $this->tokenManager = $tokenManager;
        $this->billingManager = $billingManager;
        $this->subscriptionManager = $subscriptionManager;
    }

    /**
     * get shop by particular event
     * @param AppstoreEvent $event
     * @return \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface
     */
    protected function getShopByEvent(AppstoreEvent $event){
        $params = $event->getPayload();

        $appName = $event->getApplicationName();
        $shopName = $params['shop'];

        return $this->shopManager->getRepository()->findOneByNameAndApplication($shopName, $appName);
    }

    /**
     * handle installation event
     * @param InstallEvent $event
     * @return bool
     */
    public function onInstall(InstallEvent $event){

        // extract shop entity from event
        $shop = $this->getShopByEvent($event);

        // already installed, skip
        if($shop){
            return false;
        }

        try {

            $params = $event->getPayload();
            $app = $event->getApplication();

            // perform client instantiation
            $client = Client::factory(
                Client::ADAPTER_OAUTH,
                [
                    'entrypoint'=>$params['shop_url'],
                    'client_id'=>$app['app_id'],
                    'client_secret'=>$app['app_secret']
                ]
            );

            // and get tokens
            $token = $client->authenticate($params['auth_code']);

        }catch(ClientException $ex){
            return false;
        }

        // region shop
        $shopModel = $this->shopManager->create();
        $shopModel->setApp($event->getApplicationName());
        $shopModel->setName($params['shop']);
        $shopModel->setShopUrl($params['shop_url']);
        $shopModel->setVersion($params['application_version']);
        $this->shopManager->save($shopModel, false);
        // endregion

        // region token
        $tokenModel = $this->tokenManager->create();
        $tokenModel->setAccessToken($token['access_token']);
        $tokenModel->setRefreshToken($token['refresh_token']);

        $expiresAt = new \DateTime();
        $expiresAt->add(\DateInterval::createFromDateString($token['expires_in'].' seconds'));

        $tokenModel->setExpiresAt($expiresAt);
        $tokenModel->setShop($shopModel);

        $this->tokenManager->save($tokenModel);
        // endregion

    }

    /**
     * uninstall shop from application
     * @param UninstallEvent $event
     * @return bool
     */
    public function onUninstall(UninstallEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop){
            return false;
        }

        // simply delete entity by manager
        $this->shopManager->delete($shop);
    }

    /**
     * application installation got paid
     * @param BillingInstallEvent $event
     * @return bool
     */
    public function onPaid(BillingInstallEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop){
            return false;
        }

        $billing = new Billing();
        $billing->setShop($shop);

        $this->billingManager->save($billing);
    }

    /**
     * application subscription got paid
     * @param SubscriptionEvent $event
     * @return bool
     */
    public function onSubscribed(SubscriptionEvent $event){

        $shop = $this->getShopByEvent($event);

        if(!$shop){
            return false;
        }

        $subscription = new Subscription();

        // convert date string to an object
        $expiresAt = new \DateTime($event->getPayload()['subscription_end_time']);

        $subscription->setExpiresAt($expiresAt);
        $subscription->setShop($shop);

        $this->subscriptionManager->save($subscription);

    }

    /**
     * shop installed an upgraded version
     * @param UpgradeEvent $event
     * @return bool
     */
    public function onUpgraded(UpgradeEvent $event){
        $shop = $this->getShopByEvent($event);

        if(!$shop){
            return false;
        }

        $shop->setVersion($event->getPayload()['application_version']);
        $this->shopManager->save($shop);
    }

}