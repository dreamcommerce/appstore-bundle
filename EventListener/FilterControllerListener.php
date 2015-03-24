<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:37
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Controller\FilteredController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class FilterControllerListener{

    protected $applications;

    public function __construct($applications){
        $this->applications = $applications;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        /**
         * @var $controller FilteredController
         */
        $controller = $event->getController();
        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof FilteredController) {

            $client = new Client('http://example.com', '1234', '3214');
            $event->getRequest()->attributes->add(array(
                'shopId'=>'asd'
            ));

            $controller[0]->injectClient($client);
            //throw new AccessDeniedHttpException('This action needs a valid token!');
        }
    }

    public function onKernelResponse(FilterResponseEvent $event){
        $response = $event->getResponse();
        if($response instanceof RedirectResponse){
            $attributes = $event->getRequest()->attributes;
            if($attributes->has('shopId')){
                // todo: url building
                $url = $response->getTargetUrl();
                $response->setTargetUrl($url.'?shopId='.$attributes->get('shopId'));
            }
        }
    }
}