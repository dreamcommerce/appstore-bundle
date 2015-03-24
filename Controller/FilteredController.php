<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:36
 */

namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;

interface FilteredController {

    public function injectClient(Client $client);

}