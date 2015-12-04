<?php

namespace DreamCommerce\ShopAppstoreBundle\Model\Shop;

interface WebhookInterface extends ResourceDependentInterface
{
    /**
     * @return string
     */
    public function getSecret();
}