<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreBundle\Form\AppstoreRequestType;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResponderController extends Controller
{
    // todo: install, uninstall, upgrade, subscription actions/events
    public function indexAction(Request $request)
    {

        /**
         * @var $logger Logger
         */
        $logger = $this->get('logger');

        $content = '';

        // todo: perhaps move this logic to RequestValidator to be performed
        $apps = $this->container->getParameter('dream_commerce_shop_appstore.applications');

        $defaults = array();
        $form = $this->createForm(new AppstoreRequestType(), $defaults);
        $form->handleRequest($request);

        if(!$form->isValid()){
            throw new InvalidRequestException('Incorrect callback');
        }

        $found = null;

        foreach($apps as $id=>$data){
            if($form->get('application_code')->getData()==$data['app_id']){
                $found = $data;
                break;
            }
        }

        if(!$found){
            throw new InvalidRequestException(sprintf('Application ID#%s not configured', $id));
        }

        try {
            $validator = new RequestValidator($request, $found);
            $validator->validate();
        }catch (InvalidRequestException $ex){
            $logger->addDebug('Sth wrong', (array)$ex);
        }

        $content = 'yeh';


        //$application = $this->get('dream_commerce_shop_appstore.test_app');
        /**
         * @var $manager ShopManagerInterface
         */
        /*$manager = $this->get('dream_commerce_shop_appstore.shop_manager');
        $data = $manager->findShopByName('4534ff392039f');

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
