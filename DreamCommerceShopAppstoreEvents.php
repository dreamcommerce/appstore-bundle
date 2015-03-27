<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:19
 */

namespace DreamCommerce\ShopAppstoreBundle;


final class DreamCommerceShopAppstoreEvents {

    const APPLICATION_INSTALLED = 'dream_commerce_shop_appstore.install';
    const APPLICATION_UNINSTALLED = 'dream_commerce_shop_appstore.uninstall';
    const APPLICATION_PAID = 'dream_commerce_shop_appstore.billing_install';
    const APPLICATION_UPGRADED = 'dream_commerce_shop_appstore.upgrade';
    const APPLICATION_SUBSCRIPTION = 'dream_commerce_shop_appstore.subscription_paid';

}