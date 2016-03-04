<?php
namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

/**
 * Interface ApplicationControllerInterface
 * if a controller implements this interface, it will be checked against iframe parameters
 * @package DreamCommerce\ShopAppstoreBundle\Controller
 */
interface ApplicationControllerInterface {

    public function injectClient(ClientInterface $client, ShopInterface $shop);

}