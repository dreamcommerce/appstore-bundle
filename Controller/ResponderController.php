<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopManagerInterface;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponderController extends Controller
{
    // todo: install, uninstall, upgrade, subscription actions/events
    public function indexAction(Request $request)
    {

        //$application = $this->get('dream_commerce_shop_appstore.test_app');
        /**
         * @var $manager ShopManagerInterface
         */
        $manager = $this->get('dream_commerce_shop_appstore.shop_manager');
        $data = $manager->findShopByName('4534ff392039f');

        /**
         * @var $data ShopInterface
         */
        $res = '';
        if($data){
            $t = $data->getToken();
            $date = $t->getExpiresAt()->format('c');
            $res .= $date.PHP_EOL;
        }

        return $this->render('default/index.html.twig', array('content'=>$res));
    }
}
