<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreLib\Client\OAuth;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\ShopAppstoreLib\Exception\Exception as ClientException;
use DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\TokenInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\TokenRefresher\Exception;

/**
 * Class TokenRefresher
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class TokenRefresher {

    /**
     * shop handle
     * @var ShopInterface
     */
    protected $shop;
    /**
     * data persistence layer
     * @var ObjectManagerInterface
     */
    protected $manager;

    /**
     * shop communication library
     * @var OAuth
     */
    protected $client;

    /**
     * @param ObjectManagerInterface $manager
     */
    public function __construct(ObjectManagerInterface $manager){
        $this->manager = $manager;
    }

    /**
     * shop client library
     * @param ClientInterface $client
     */
    public function setClient(OAuth $client){
        $this->client = $client;
    }

    /**
     * refresh OAuth token
     * @param ShopInterface $shop
     * @return TokenInterface
     * @throws Exception
     */
    public function refresh(ShopInterface $shop){

        if(!$this->client){
            throw new Exception('No client specified');
        }

        $token = $shop->getToken();

        $refreshToken = $token->getRefreshToken();

        try{
            $this->client->setRefreshToken($refreshToken);
            $newToken = $this->client->refreshTokens();
            $token->setExpiresAt(new \DateTime('+'.(int)$newToken['expires_in'].' seconds'));
            $token->setAccessToken($newToken['access_token']);
            $token->setRefreshToken($newToken['refresh_token']);

            $this->manager->save($token);
        }catch (ClientException $ex){
            throw new Exception('Unable to refresh tokens: '.$ex->getHttpError(), 0, $ex);
        }

        return $token;
    }

}