<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types;

use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

/**
 * Interface ApplicationControllerInterface
 * if a controller implements this interface, it will be checked against iframe parameters
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types
 */
interface ApplicationControllerInterface {

    public function injectClient(ClientInterface $client, ShopInterface $shop);

}