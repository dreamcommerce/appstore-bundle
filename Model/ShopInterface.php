<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-23
 * Time: 17:27
 */
namespace DreamCommerce\ShopAppstoreBundle\Model;

interface ShopInterface
{
    public function setName($name);

    public function getName();

    public function setShopUrl($shopUrl);

    public function getShopUrl();

    /**
     * @return TokenInterface
     */
    public function getToken();

    public function setToken(TokenInterface $token);
}