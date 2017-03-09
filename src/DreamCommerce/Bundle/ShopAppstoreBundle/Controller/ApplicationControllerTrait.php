<?php
/**
 * Created by PhpStorm.
 * User: daniel
 * Date: 08.03.17
 * Time: 11:25
 */

namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;

trait ApplicationControllerTrait
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * method used by request filter - injects current client and shop instance
     * @param Client $client
     * @param ShopInterface $shop
     */
    public function injectClient(ClientInterface $client, ShopInterface $shop){
        $this->client = $client;
        $this->shop = $shop;
    }
}