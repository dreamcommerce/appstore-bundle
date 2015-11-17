<?php
namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Router;

/**
 * Class Url
 *
 * URL generating helper service
 *
 * @package DreamCommerce\ShopAppstoreBundle\Utils
 */
class Url {

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Service
     */
    protected $requestValidator;
    /**
     * @var Router
     */
    protected $router;

    /**
     * @param RequestStack $requestStack
     * @param Service $requestValidatorService
     * @param Router $router
     */
    public function __construct(RequestStack $requestStack, Service $requestValidatorService, Router $router){
        $this->request = $requestStack->getCurrentRequest();
        $this->requestValidator = $requestValidatorService;
        $this->router = $router;
    }

    /**
     * add query string parameters to the URL
     * @param $url
     * @param $parameters
     * @return string
     */
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

    /**
     * appends application parameters to URL based on current request
     * @param $url
     * @return string
     */
    public function appendApplicationParameters($url){
        $params = $this->getApplicationParameters();
        return self::addUrlParameters($url, $params);
    }

    /**
     * generate URL from route
     * @see UrlGeneratorInterface::generate
     * @param string $route
     * @param array $parameters
     * @param bool $referenceType
     * @return string
     */
    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH){
        $url = $this->router->generate($route, $parameters, $referenceType);
        $params = $this->getApplicationParameters();
        return self::addUrlParameters($url, $params);
    }

    /**
     * get appstore iframe parameters
     * @return array
     */
    public function getApplicationParameters(){
        $params = $this->requestValidator->getAppValidationParams();

        $additionalParams = [];
        foreach([
            'application',
            'application-version',
            'translations',
            'locale',
            'version',
            'place'
        ] as $param){
            $value = $this->request->query->get($param);
            if($value){
                $additionalParams[$param] = $value;
            }
        }

        $params = $params + $additionalParams;
        return $params;
    }

}