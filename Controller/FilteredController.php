<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 15:10
 */

namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class FilteredController extends Controller implements FilteredControllerInterface{

    /**
     * @var Client
     */
    protected $client;

    public function injectClient(Client $client){
        $this->client = $client;
    }

}