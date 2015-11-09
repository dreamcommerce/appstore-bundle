<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-23
 * Time: 17:49
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;

interface TokenInterface
{
    public function setExpiresAt(\DateTime $expiresAt);

    /**
     * @return \DateTime
     */
    public function getExpiresAt();

    public function setAccessToken($accessToken);

    public function getAccessToken();

    public function setRefreshToken($refreshToken);

    public function getRefreshToken();

    public function setShop(ShopInterface $shop = null);

    public function getShop();
}