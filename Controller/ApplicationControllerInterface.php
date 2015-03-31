<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:36
 */

namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;

interface ApplicationControllerInterface {

    public function injectClient(Client $client, ShopInterface $shop);

}