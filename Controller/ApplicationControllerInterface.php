<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;


use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Model\ShopInterface;

/**
 * Interface ApplicationControllerInterface
 * if a controller implements this interface, it will be checked against iframe parameters
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Controller
 */
interface ApplicationControllerInterface {

    public function injectClient(ClientInterface $client, ShopInterface $shop);

}