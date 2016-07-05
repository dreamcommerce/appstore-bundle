<?php
namespace DreamCommerce\ShopAppstoreBundle;


final class DreamCommerceShopAppstoreEvents
{

    const APPLICATION_INSTALLED = 'dream_commerce_shop_appstore.event.install';
    const APPLICATION_UNINSTALLED = 'dream_commerce_shop_appstore.event.uninstall';
    const APPLICATION_PAID = 'dream_commerce_shop_appstore.event.pay';
    const APPLICATION_UPGRADED = 'dream_commerce_shop_appstore.event.upgrade';
    const APPLICATION_SUBSCRIPTION = 'dream_commerce_shop_appstore.event.subscribe';

    protected $supportedWebhooks = [
        'client.create',
        'client.edit',
        'client.delete',
        'product.create',
        'product.edit',
        'product.delete',
        'parcel.create',
        'parcel.delete',
        'parcel.dispatch',
        'subscriber.create',
        'subscriber.edit',
        'subscriber.delete',
        'order.create',
        'order.edit',
        'order.paid',
        'order.delete',
        'order.status'
    ];

    public function getSupportedWebhooks()
    {
        return $this->supportedWebhooks;
    }

}