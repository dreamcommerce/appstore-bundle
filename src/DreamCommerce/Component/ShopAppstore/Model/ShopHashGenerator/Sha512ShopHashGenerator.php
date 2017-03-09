<?php
namespace DreamCommerce\Component\ShopAppstore\Model\ShopHashGenerator;


use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;

class Sha512ShopHashGenerator implements ShopHashGenerator
{
    /**
     * Generate unique identifier for shop, identifier will set to shop metafield.
     *
     * @return mixed
     */
    public function generate(ApplicationPayload $payload)
    {
        $string = $payload->getShop() . $payload->getHash();
        return hash('sha512', $string);
    }
}
