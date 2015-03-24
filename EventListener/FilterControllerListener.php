<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:37
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreBundle\Controller\FilteredController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class FilterControllerListener {

    protected $request;

    public function __construct(RequestStack $req){
        $this->request = $req->getCurrentRequest();
    }

    public function onKernelController($event)
    {
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
            throw new AccessDeniedHttpException('This action needs a valid token!');
        }
    }
}