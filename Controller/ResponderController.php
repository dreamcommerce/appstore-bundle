<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        /**
         * @var $logger Logger
         */

        return new Response();
    }
}
