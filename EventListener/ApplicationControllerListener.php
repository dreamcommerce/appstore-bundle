<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2015-03-24
 * Time: 16:37
 */

namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\Client;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\ShopAppstoreBundle\Controller\ApplicationControllerInterface;
use DreamCommerce\ShopAppstoreBundle\Controller\PaidControllerInterface;
use DreamCommerce\ShopAppstoreBundle\Controller\SubscribedControllerInterface;
use DreamCommerce\ShopAppstoreBundle\EntityManager\ShopManagerInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use DreamCommerce\ShopAppstoreBundle\Utils\TokenRefresher;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

// todo: invalid token handling/refreshing
class ApplicationControllerListener{

    protected $applications;
    protected $shopManager;
    protected $routes;
    /**
     * @var TokenRefresher
     */
    protected $refresher;

    protected $lastEvent;

    public function __construct($configuration, ShopManagerInterface $shopManager, TokenRefresher $refresher){
        $this->applications = $configuration['applications'];
        $this->routes = $configuration['routes'];
        $this->shopManager = $shopManager;
        $this->refresher = $refresher;
    }

    /**
     * @param FilterControllerEvent $event
     * @throws HttpException
     */
    public function onKernelController(FilterControllerEvent $event)
    {

        $this->lastEvent = $event;

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
                    $this->redirect($event, 'unpaid');
                }
            }

            if($controller[0] instanceof SubscribedControllerInterface){
                $subscriptions = $shop->getSubscriptions();
                if(empty($subscriptions)){
                    $this->redirect($event, 'unsubscribed');
                }

                $newest = $subscriptions[0];
                $expires = $newest->getExpiresAt();

                if($expires<new \DateTime()){
                    $this->redirect($event, 'not_installed');
                }
            }

            $token = $shop->getToken();

            $client = new Client($shop->getShopUrl(), $appData['app_id'], $appData['app_secret']);

            if($token->getExpiresAt()->getTimestamp() - (new \DateTime())->getTimestamp() < 86400){
                $this->refresher->setClient($client);
                $this->refresher->refresh($shop);
            }

            $client->setAccessToken($token->getAccessToken());
            $client->setOnTokenInvalidHandler(array($this, 'invalidTokenRedirect'));

            $controller[0]->injectClient($client, $shop);
        }
    }

    protected function redirect(FilterControllerEvent $event, $routeName){
        $controller = $event->getController();
        $controller = is_array($controller) ? $controller[0] : $controller;

        $route = $this->routes[$routeName];

        $url = $controller->generateUrl($route);

        throw new HttpException(307, null, null, array('Location' => $url));
    }

    public function invalidTokenRedirect(Client $client, \Exception $ex){
        $this->redirect($this->lastEvent, 'reinstall', null);
        return true;
    }

}