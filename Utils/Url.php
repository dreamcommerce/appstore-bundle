<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-31
 * Time: 11:38
 */

namespace DreamCommerce\ShopAppstoreBundle\Utils;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

class Url {

    protected $request;
    protected $requestValidator;
    protected $router;

    public function __construct(RequestStack $requestStack, RequestValidatorService $requestValidatorService, Router $router){
        $this->request = $requestStack->getCurrentRequest();
        $this->requestValidator = $requestValidatorService;
        $this->router = $router;
    }

    public static function addUrlParameters($url, $parameters){
        $components = parse_url($url);
        $query = array();

        if(!empty($components['query'])) {
            parse_str($components['query'], $query);
        }

        $query = $query + $parameters;
        $queryString = http_build_query($query);

        // htt_build_url is not widely available
        $queryPos = strpos($url, '?');
        if($queryPos!==false){
            $url = substr($url, 0, $queryPos);
        }

        return $url.'?'.$queryString;
    }

    public function adjustUrl($url){
        $params = $this->getApplicationParameters();
        return self::addUrlParameters($url, $params);
    }

    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH){
        $url = $this->router->generate($route, $parameters, $referenceType);
        $params = $this->getApplicationParameters();
        return self::addUrlParameters($url, $params);
    }

    public function getApplicationParameters(){
        $params = $this->requestValidator->getAppValidationParams();
        $params = $params + array('application'=>$this->request->query->get('application'));
        return $params;
    }

}