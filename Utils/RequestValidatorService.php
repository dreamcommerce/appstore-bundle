<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-30
 * Time: 15:06
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use Symfony\Component\HttpFoundation\RequestStack;

class RequestValidatorService extends RequestValidator{

    public function __construct(RequestStack $rs = null){
        $this->setRequestStack($rs);
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