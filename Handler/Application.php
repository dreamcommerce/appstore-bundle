<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-20
 * Time: 15:31
 */

namespace DreamCommerce\ShopAppstoreBundle\Handler;


use Monolog\Logger;

class Application {

    public function __construct(Logger $logger, $appId, $appSecret, $appstoreSecret){
        $logger->addNotice('application added', func_get_args());
    }

}