<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-28
 * Time: 15:10
 */

namespace DreamCommerce\ShopAppstoreBundle\Controller;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class FilteredController extends Controller implements FilteredControllerInterface{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function injectClient(Client $client, ShopInterface $shop){
        $this->client = $client;
        $this->shop = $shop;
    }

}