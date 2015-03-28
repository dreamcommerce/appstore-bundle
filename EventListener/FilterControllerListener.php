<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:37
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Controller\FilteredController;
use DreamCommerce\ShopAppstoreBundle\EntityManager\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

// todo: invalid token handling/refreshing
class FilterControllerListener{

    protected $applications;
    protected $shopManager;

    public function __construct($applications, ShopManagerInterface $shopManager){
        $this->applications = $applications;
        $this->shopManager = $shopManager;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        /**
         * @var $controller FilteredController
         */
        $controller = $event->getController();
        /*
         * $controller passed can be either a class or a Closure.
         * This is not usual in Symfony but it may happen.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof FilteredController) {

            $request = $event->getRequest();
            $appId = $request->query->get('app_id');
            if(!$appId){
                throw new BadRequestHttpException('Missing application identifier');
            }

            if(!isset($this->applications[$appId])){
                throw new BadRequestHttpException('Application not exists');
            }

            $appData = $this->applications[$appId];

            $requestValidator = new RequestValidator($request, $appData);
            try{
                $params = $requestValidator->validate();
            }catch(InvalidRequestException $ex){
                throw new BadRequestHttpException('Invalid request');
            }

            $shop = $this->shopManager->findShopByNameAndApplication($params['shop'], $appId);

            if(!$shop){
                throw new AccessDeniedHttpException('Application not found');
            }

            $token = $shop->getToken();

            $client = new Client($shop->getShopUrl(), $appData['app_id'], $appData['app_secret']);
            $client->setAccessToken($token->getAccessToken());

            $parameters = array(
                'validation_params'=>
                    $params + array(
                        'app_id' => $appId
                    )
            );
            $event->getRequest()->attributes->add($parameters);

            $controller[0]->injectClient($client);
        }
    }

    public function onKernelResponse(FilterResponseEvent $event){
        $response = $event->getResponse();
        if($response instanceof RedirectResponse){
            $attributes = $event->getRequest()->attributes;
            if($attributes->has('validation_params')){
                $url = $response->getTargetUrl();

                $components = parse_url($url);
                $query = array();

                parse_str($components['query'], $query);
                $query = $query+$attributes->get('validation_params');
                $components['query'] = http_build_query($query);

                $url = http_build_url($components);

                $response->setTargetUrl($url);
            }
        }
    }
}