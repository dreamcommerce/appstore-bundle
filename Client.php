<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-18
 * Time: 12:58
 */

namespace DreamCommerce\ShopAppstoreBundle;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\RequestStack;


class Client{

    protected $logger;
    protected $requestStack;

    function __construct(Logger $logger, $dataStack, RequestStack $requestStack = null){

        $this->logger = $logger;

        $this->requestStack = $requestStack;

        $logger->error('init');
    }

    public function indexAction(){

    }

}