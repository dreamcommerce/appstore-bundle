<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        /**
         * @var $logger Logger
         */
        $logger = $this->get('logger');
        $logger->debug('testtesttest');

        $name = $request->getClientIp();


        return $this->render('DreamCommerceShopAppstoreBundle:Default:index.html.twig', array('name' => $name));
    }
}
