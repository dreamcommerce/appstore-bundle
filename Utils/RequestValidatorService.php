<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils;


use Symfony\Component\HttpFoundation\RequestStack;

class RequestValidatorService extends RequestValidator{

    public function __construct(RequestStack $rs = null){
        $this->setRequestStack($rs);
        parent::__construct($rs->getCurrentRequest());
    }

    public function setRequestStack(RequestStack $requestStack = null){
        if($requestStack){
            $request = $requestStack->getCurrentRequest();
            if($request) {
                parent::__construct($request);
            }
        }
    }

}