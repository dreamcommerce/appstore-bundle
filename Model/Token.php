<?php

namespace DreamCommerce\ShopAppstoreBundle\Model;

abstract class Token implements TokenInterface
{
    protected $id;

    protected $expiresAt;

    protected $accessToken;

    protected $refreshToken;

    protected $shop;

    public function getId()
    {
        return $this->id;
    }

    public function setExpiresAt(\DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function setShop(ShopInterface $shop = null)
    {
        $this->shop = $shop;

        return $this;
    }

    public function getShop()
    {
        return $this->shop;
    }

}
