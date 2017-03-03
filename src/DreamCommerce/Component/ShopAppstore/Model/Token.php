<?php

namespace DreamCommerce\Component\ShopAppstore\Model;

/**
 * Class Token
 *
 * OAuth tokens instance
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
abstract class Token implements TokenInterface
{
    /**
     * expiration date
     * @var \DateTime
     */
    protected $expiresAt;

    /**
     * access token
     * @var string
     */
    protected $accessToken;

    /**
     * refresh token
     * @var string
     */
    protected $refreshToken;

    /**
     * shop handle
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @inheritdoc
     */
    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @inheritdoc
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @inheritdoc
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @inheritdoc
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @inheritdoc
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * @inheritdoc
     */
    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }

    /**
     * @inheritdoc
     */
    public function getShop()
    {
        return $this->shop;
    }

}
