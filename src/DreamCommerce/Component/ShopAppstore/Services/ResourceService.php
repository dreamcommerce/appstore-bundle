<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 08.03.17
 * Time: 14:47
 */

namespace DreamCommerce\Component\Services;


use DreamCommerce\Component\Common\Http\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\Shop\Metafield;
use DreamCommerce\Component\ShopAppstore\Model\Shop\MetafieldValue;

use DreamCommerce\ShopAppstoreLib\Resource;

class ResourceService
{
    public function insertMetafield(ClientInterface $client, Metafield $metafield)
    {
        $resource = new Resource\Metafield($client);

    }

    public function insertMetafieldValue(ClientInterface $client, MetafieldValue $metafieldValue)
    {

    }
}