<?php
namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

/**
 * Interface ApplicationControllerInterface
 * if a controller implements this interface, it will be checked against iframe parameters
 * @package DreamCommerce\ShopAppstoreBundle\Controller
 */
interface ApplicationControllerInterface {

    public function injectClient(Client $client, ShopInterface $shop);

}