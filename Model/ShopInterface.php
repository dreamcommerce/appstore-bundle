<?php
namespace DreamCommerce\ShopAppstoreBundle\Model;

/**
 * Interface ShopInterface
 *
 * shop entity interface
 *
 * @package DreamCommerce\ShopAppstoreBundle\Model
 */
interface ShopInterface
{
    /**
     * @return BillingInterface
     */
    public function getBilling();

    /**
     * set shop name
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * get shop name
     * @return string
     */
    public function getName();

    /**
     * set shop url
     * @param string $shopUrl
     * @return void
     */
    public function setShopUrl($shopUrl);

    /**
     * get shop url
     * @return string
     */
    public function getShopUrl();

    /**
     * get token information
     * @return TokenInterface
     */
    public function getToken();

    /**
     * set token information
     * @param TokenInterface $token
     * @return void
     */
    public function setToken(TokenInterface $token);

    /**
     * get paid subscriptions by shop
     * @return SubscriptionInterface[]
     */
    public function getSubscriptions();

    /**
     * add subscription
     * @param SubscriptionInterface $subscription
     * @return void
     */
    public function addSubscription(SubscriptionInterface $subscription);

    /**
     * get application name
     * @return string
     */
    public function getApp();

    /**
     * set application name
     * @param string $app
     * @return void
     */
    public function setApp($app);

    /**
     * get installed version
     * @return integer
     */
    public function getVersion();

    /**
     * set installed application version
     * @param integer $version
     * @return void
     */
    public function setVersion($version);

    /**
     * get installed
     * @return bool
     */
    public function getInstalled();

    /**
     * set installed
     * @param bool $installed
     * @return void
     */
    public function setInstalled($installed);
}