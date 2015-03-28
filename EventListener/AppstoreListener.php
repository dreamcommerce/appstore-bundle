<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:18
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\Client;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\ShopAppstoreBundle\EntityManager\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\EntityManager\TokenManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\InstallEvent;

class AppstoreListener implements ActionListenerInterface{

    protected $shopManager;
    protected $tokenManager;

    public function __construct(ShopManagerInterface $shopManager, TokenManagerInterface $tokenManager){
        $this->shopManager = $shopManager;
        $this->tokenManager = $tokenManager;
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

}