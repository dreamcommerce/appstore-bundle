<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:37
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\Client;
use DreamCommerce\ShopAppstoreBundle\Controller\ApplicationControllerInterface;
use DreamCommerce\ShopAppstoreBundle\Controller\PaidControllerInterface;
use DreamCommerce\ShopAppstoreBundle\EntityManager\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

// todo: invalid token handling/refreshing
class ApplicationControllerListener{

    protected $applications;
    protected $shopManager;

    public function __construct($applications, ShopManagerInterface $shopManager){
        $this->applications = $applications;
        $this->shopManager = $shopManager;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        /**
         * @var $controller ApplicationControllerInterface
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

        if ($controller[0] instanceof ApplicationControllerInterface) {

            $request = $event->getRequest();

            $requestValidator = new RequestValidator($request);

            try{
                $appName = $requestValidator->getApplicationName($this->applications);
                $appData = $this->applications[$appName];
                $requestValidator->setApplication($appData);
                $params = $requestValidator->validateAppRequest();
            }catch(InvalidRequestException $ex){
                throw new BadRequestHttpException('Invalid request');
            }

            if($request->query->has('id')){
                $ids = $request->query->get('id');
                $idsList = @json_decode($ids);
                $request->query->set('id', $idsList);
            }

            $shop = $this->shopManager->findShopByNameAndApplication($params['shop'], $appName);

            if(!$shop){
                throw new AccessDeniedHttpException('Application not found');
            }

            if($controller[0] instanceof PaidControllerInterface){
                $billing = $shop->getBilling();
                if(empty($billing)){
                    // todo payment missing route
                    throw new HttpException(402, 'Payment Required');
                }
            }

            $token = $shop->getToken();

            $client = new Client($shop->getShopUrl(), $appData['app_id'], $appData['app_secret']);
            $client->setAccessToken($token->getAccessToken());

            $controller[0]->injectClient($client, $shop);
        }
    }

}