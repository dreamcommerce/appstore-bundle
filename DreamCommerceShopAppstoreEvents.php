<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-25
 * Time: 13:19
 */

namespace DreamCommerce\ShopAppstoreBundle;


final class DreamCommerceShopAppstoreEvents {

    const APPLICATION_INSTALLED     = 'dream_commerce_shop_appstore.install';
    const APPLICATION_UNINSTALLED   = 'dream_commerce_shop_appstore.uninstall';
    const APPLICATION_PAID          = 'dream_commerce_shop_appstore.billing_install';
    const APPLICATION_UPGRADED      = 'dream_commerce_shop_appstore.upgrade';
    const APPLICATION_SUBSCRIPTION  = 'dream_commerce_shop_appstore.subscription_paid';

    const WEBHOOK_ORDER             = 'dream_commerce_shop_webhook.order';
    const WEBHOOK_ORDER_CREATE      = 'dream_commerce_shop_webhook.order_create';
    const WEBHOOK_ORDER_EDIT        = 'dream_commerce_shop_webhook.order_edit';
    const WEBHOOK_ORDER_DELETE      = 'dream_commerce_shop_webhook.order_delete';
    const WEBHOOK_ORDER_PAID        = 'dream_commerce_shop_webhook.order_paid';
    const WEBHOOK_ORDER_STATUS      = 'dream_commerce_shop_webhook.order_status';

    const WEBHOOK_CLIENT            = 'dream_commerce_shop_webhook.client';
    const WEBHOOK_CLIENT_CREATE     = 'dream_commerce_shop_webhook.client_create';
    const WEBHOOK_CLIENT_EDIT       = 'dream_commerce_shop_webhook.client_edit';
    const WEBHOOK_CLIENT_DELETE     = 'dream_commerce_shop_webhook.client_delete';

    const WEBHOOK_PRODUCT           = 'dream_commerce_shop_webhook.product';
    const WEBHOOK_PRODUCT_CREATE    = 'dream_commerce_shop_webhook.product_create';
    const WEBHOOK_PRODUCT_EDIT      = 'dream_commerce_shop_webhook.product_edit';
    const WEBHOOK_PRODUCT_DELETE    = 'dream_commerce_shop_webhook.product_delete';

    const WEBHOOK_PARCEL            = 'dream_commerce_shop_webhook.parcel';
    const WEBHOOK_PARCEL_CREATE     = 'dream_commerce_shop_webhook.parcel_create';
    const WEBHOOK_PARCEL_EDIT       = 'dream_commerce_shop_webhook.parcel_edit';
    const WEBHOOK_PARCEL_DELETE     = 'dream_commerce_shop_webhook.parcel_delete';
}