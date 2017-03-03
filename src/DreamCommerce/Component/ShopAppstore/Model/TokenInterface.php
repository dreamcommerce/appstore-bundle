<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface TokenInterface
 *
 * tokens information
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface TokenInterface extends ResourceInterface
{
    /**
     * set expiration date
     * @param \DateTime $expiresAt
     * @return void
     */
    public function setExpiresAt(\DateTime $expiresAt);

    /**
     * get expiration date
     * @return \DateTime
     */
    public function getExpiresAt();

    /**
     * set access token
     * @param string $accessToken
     * @return mixed
     */
    public function setAccessToken($accessToken);

    /**
     * get access token
     * @return string
     */
    public function getAccessToken();

    /**
     * set refresh token
     * @param string $refreshToken
     * @return mixed
     */
    public function setRefreshToken($refreshToken);

    /**
     * get refresh token
     * @return string
     */
    public function getRefreshToken();

    /**
     * set shop
     * @param ShopInterface $shop
     * @return mixed
     */
    public function setShop(ShopInterface $shop);

    /**
     * get shop
     * @return ShopInterface
     */
    public function getShop();
}