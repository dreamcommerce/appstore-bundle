<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\Exception\HttpException;
use DreamCommerce\Exception\ResourceException;

class ApiExceptionParser
{

    public static function getHttpErrorCode(ResourceException $ex){
        while($ex->getPrevious()){
            $ex = $ex->getPrevious();
        }

        if(!($ex instanceof HttpException)){
            return false;
        }

        $headers = $ex->getHeaders();
        return $headers['Code'];
    }

}