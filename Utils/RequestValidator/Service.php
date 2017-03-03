<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;


use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class Service
 *
 * service for request validator - wraps request handling
 *
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Utils
 */
class Service extends RequestValidator{

    protected $requestStack = null;

    /**
     * Service constructor.
     * @param RequestStack|null $rs
     */
    public function __construct(RequestStack $rs = null){
        $this->requestStack = $rs;
    }

    /**
     * override parent::getRequest in order to fetch Request from stack
     * @return null|\Symfony\Component\HttpFoundation\Request
     */
    protected function getRequest()
    {
        return $this->requestStack->getMasterRequest();
    }

}