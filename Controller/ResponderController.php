<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreBundle\Model\ShopManagerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponderController extends Controller
{
    public function indexAction(Request $request)
    {

        //$application = $this->get('dream_commerce_shop_appstore.test_app');
        /**
         * @var $manager ShopManagerInterface
         */
        $manager = $this->get('dream_commerce_shop_appstore.shop_manager');
        $data = $manager->findAll();

        return new Response();
    }
}
