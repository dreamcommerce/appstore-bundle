<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;


use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class Service
 *
 * service for request validator - wraps request handling
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class Service extends RequestValidator{

    public function __construct(RequestStack $rs = null){
        $this->setRequestStack($rs);
    }

    /**
     * method for request injection
     * @param RequestStack|null $requestStack
     */
    public function setRequestStack(RequestStack $requestStack = null){
        if($requestStack){
            $request = $requestStack->getCurrentRequest();
            if($request) {
                parent::__construct($request);
            }
        }
    }

}