<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreBundle\Form\AppstoreRequestType;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ResponderController extends Controller
{
    // todo: install, uninstall, upgrade, subscription actions/events
    public function indexAction(Request $request)
    {

        /**
         * @var $logger Logger
         */
        $logger = $this->get('logger');

        $apps = $this->container->getParameter('dream_commerce_shop_appstore.applications');

        $validator = new RequestValidator($request);

        try {
            $appName = $validator->getApplicationName($apps);
            $validator->setApplication($apps[$appName]);
            $params = $validator->validateAppstoreRequest();
        }catch (InvalidRequestException $ex){
            throw new BadRequestHttpException($ex->getMessage());
        }


        /**
         * @var $manager ShopManagerInterface
         */
        $manager = $this->get('dream_commerce_shop_appstore.shop_manager');
        $data = $manager->findShopByNameAndApplication($params['shop'], $appName);

        if($data){
            throw new ConflictHttpException(sprintf('Shop %s already exists', $params['shop']));
        }



        /**
         * @var $data ShopInterface
         */
        /*$res = '';
        if($data){
            $t = $data->getToken();
            $date = $t->getExpiresAt()->format('c');
            $res .= $date.PHP_EOL;
        }*/

        return $this->render('default/index.html.twig');
    }
}
