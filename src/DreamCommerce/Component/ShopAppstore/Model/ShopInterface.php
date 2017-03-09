<?php
namespace DreamCommerce\Component\ShopAppstore\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface ShopInterface
 *
 * shop entity interface
 *
 * @package DreamCommerce\Component\ShopAppstore\Model
 */
interface ShopInterface extends ResourceInterface
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

    /**
     * Unique shop identifier that can be showing on shop front by metafield.system.__NAMESPACE__.shop_hash metafield.
     * __NAMESPACE__ is parameter you define in config.yml under key dream_commerce_shop_appstore.application_namespace.
     * default application_namespace value is "dream_commerce_appstore".
     *
     * e.g for my rma namespace snippet code is:
     * {if metafield.system.rma.shop_hash}
     *      <script type="text/javascript">
     *      var __METAFIELD_SHOP_HASH = {metafield.system.rma.shop_hash}
     *      </script>
     * {/if}
     *
     * @param string $hash
     * @return mixed
     */
    public function setHash(string $hash);

    /**
     * @return string
     */
    public function getHash();
}