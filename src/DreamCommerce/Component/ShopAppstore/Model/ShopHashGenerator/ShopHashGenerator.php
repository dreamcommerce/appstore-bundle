<?php
namespace DreamCommerce\Component\ShopAppstore\Model\ShopHashGenerator;


use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;

interface ShopHashGenerator
{
    /**
     * Generate unique identifier for shop, identifier will set to shop metafield.
     *
     * @return mixed
     */
    public function generate(ApplicationPayload $payload);
}