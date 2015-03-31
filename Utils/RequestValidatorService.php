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

    public function __construct(RequestStack $rs){
        parent::__construct($rs->getCurrentRequest());
    }

}