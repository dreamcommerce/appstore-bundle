<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Client;
use DreamCommerce\ClientInterface;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\TokenRefresher\Exception;

class TokenRefresher {

    /**
     * @var ShopInterface
     */
    protected $shop;
    /**
     * @var ObjectManagerInterface
     */
    protected $manager;

    /**
     * @var ClientInterface
     */
    protected $client;

    public function __construct(ObjectManagerInterface $manager){
        $this->manager = $manager;
    }

    public function setClient(ClientInterface $client){
        $this->client = $client;
    }

    public function refresh(ShopInterface $shop){

        if(!$this->client){
            throw new Exception('No client specified');
        }

        $token = $shop->getToken();

        $refreshToken = $token->getRefreshToken();

        try{
            $newToken = $this->client->refreshToken($refreshToken);
            $token->setExpiresAt(new \DateTime('+'.(int)$newToken['expires_in'].' seconds'));
            $token->setAccessToken($newToken['access_token']);
            $token->setRefreshToken($newToken['refresh_token']);

            $this->manager->save($token);
        }catch (ClientException $ex){
            throw new Exception('', 0, $ex);
        }

        return $token;
    }

}