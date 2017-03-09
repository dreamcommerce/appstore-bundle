<?php
namespace DreamCommerce\Component\ShopAppstore\Services;


use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValue;

use DreamCommerce\ShopAppstoreLib\Resource;

class ResourceService
{
    public function insertMetafield(ClientInterface $client, Metafield $metafield)
    {
        $resource = new Resource\Metafield($client);
        $metafieldId = $resource->post($metafield->getObject(), [
            'namespace'     => $metafield->getNamespace(),
            'key'           => $metafield->getMetafieldKey(),
            'description'   => $metafield->getDescription(),
            'type'          => MetafieldValue::getMapDatabase()[$metafield->getType()]
        ]);

        $metafield->setMetafieldExternalId((int)$metafieldId);

    }

    public function insertMetafieldValue(ClientInterface $client, MetafieldValue $metafieldValue)
    {
        $resource = new Resource\MetafieldValue($client);
        $metafieldValueId = $resource->post([
            'object_id'     => $metafieldValue->getExternalObjectId(),
            'metafield_id'  => $metafieldValue->getMetafield()->getMetafieldExternalId(),
            'value'         => $metafieldValue->getValue()
        ]);

        $metafieldValue->setExternalMetafieldValueId((int)$metafieldValueId);

    }
}