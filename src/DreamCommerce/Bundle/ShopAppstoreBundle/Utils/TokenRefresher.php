<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils;


use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\ShopAppstoreLib\Client\OAuth;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\ShopAppstoreLib\Exception\ClientException;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\Component\ShopAppstore\Model\TokenInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\TokenRefresher\Exception;

/**
 * Class TokenRefresher
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Utils
 */
class TokenRefresher {

    /**
     * shop handle
     * @var ShopInterface
     */
    protected $shop;
    /**
     * data persistence layer
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * shop communication library
     * @var OAuth
     */
    protected $client;

    /**
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager){
        $this->objectManager = $manager;
    }

    /**
     * shop clienshopt library
     * @param OAuth $client
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

            $this->objectManager->persist($token);
            $this->objectManager->flush();

        }catch (ClientException $ex){
            throw new Exception('', 0, $ex);
        }

        return $token;
    }

}