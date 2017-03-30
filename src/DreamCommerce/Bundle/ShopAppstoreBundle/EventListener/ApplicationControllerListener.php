<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\EventListener;


use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\RestApplicationController;
use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\StandardApplicationControllerInterface;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;
use DreamCommerce\Component\ShopAppstore\Model\ShopInterface;
use DreamCommerce\ShopAppstoreLib\Client;
use DreamCommerce\ShopAppstoreLib\ClientInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\ApplicationControllerInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\PaidControllerInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Controller\Types\SubscribedControllerInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Handler\ApplicationRegistry;
use DreamCommerce\Component\ShopAppstore\Model\ShopRepositoryInterface;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\InvalidRequestException;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\TokenRefresher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class ApplicationControllerListener
 * takes care of restricting controller access
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\EventListener
 */
class ApplicationControllerListener{

    /**
     * applications data
     * @var array
     */
    protected $applications;
    /**
     * @var ObjectManager
     */
    protected $objectManager;
    /**
     * exception routes name
     * @var array
     */
    protected $routes;
    /**
     * @var TokenRefresher
     */
    protected $refresher;

    /**
     * used when token is invalid
     * @var FilterControllerEven
     */
    protected $lastEvent;
    /**
     * @var ApplicationRegistry
     */
    protected $applicationRegistry;
    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var RequestValidator\Types\RequestValidatorInterface
     */
    protected $requestValidator;

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * @var ApplicationPayload
     */
    protected $payload;

    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    public function __construct(
        $applications,
        $routes,
        ApplicationRegistry $applicationRegistry,
        ObjectManager $objectManager,
        TokenRefresher $refresher,
        RouterInterface $router
    )
    {
        $this->applications = $applications;
        $this->routes = $routes;
        $this->objectManager = $objectManager;
        $this->refresher = $refresher;
        $this->applicationRegistry = $applicationRegistry;
        $this->router = $router;
    }

    /**
     * @param ShopRepositoryInterface $shopRepository
     */
    public function setShopRepository(ShopRepositoryInterface $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!empty($this->controller) && $this->controller instanceof RestApplicationController) {
            $response = $event->getResponse();
            $response->headers->set('Access-Control-Allow-Origin', '*');
        }
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        // last event used before token invalid exception is thrown
        $this->lastEvent = $event;

        $this->setController($event);

        if (empty($this->controller) || !($this->controller instanceof ApplicationControllerInterface)) {
            return;
        }
        $request = $event->getRequest();
        if ($request->getMethod() === Request::METHOD_OPTIONS && $request->headers->has('access-control-request-method')) {
            return;
        }

        $this->validateRequest($request);
        $shop = $this->getShop();
        $application = $this->requestValidator->getApplication();

        // handle shop arguments on iframe (eg. product list checkboxes)
        if($request->query->has('id')) {
            $ids = $request->query->get('id');
            $idsList = @json_decode($ids);
            $request->query->set('id', $idsList);
        }

        // not installed - throw an error
        if (!$shop || !$shop->getInstalled()){
            $this->redirect($event, 'not_installed');
        }

        // verify version requirements
        if($application['minimal_version']>0){
            if($shop->getVersion()<$application['minimal_version']){
                $this->redirect($event, 'upgrade');
            }
        }

        // if an application controller needs to be paid
        if($this->controller instanceof PaidControllerInterface){
            $billing = $shop->getBilling();
            if(empty($billing)){
                $this->redirect($event, 'unpaid');
            }
        }

        // need a subscription?
        if($this->controller instanceof SubscribedControllerInterface){
            $subscriptions = $shop->getSubscriptions();
            if(!count($subscriptions)){
                $this->redirect($event, 'unsubscribed');
            }

            $newest = $subscriptions[0];
            $expires = $newest->getExpiresAt();

            if($expires<new \DateTime()){
                $this->redirect($event, 'not_installed');
            }
        }

        // get shop token
        $token = $shop->getToken();

        // instantiate a client
        /**
         * @var $client Client\Bearer
         */
        $client = $this->applicationRegistry->get($application['name'])->getClient($shop);

        // token expired - attempt to refresh
        if($token->getExpiresAt()->getTimestamp() - (new \DateTime())->getTimestamp() < 86400){
            $this->refresher->setClient($client);
            $this->refresher->refresh($shop);
        }

        // set token on client
        $client->setAccessToken($token->getAccessToken());
        // action performed on token is invalid
        $client->setOnTokenInvalidHandler(array($this, 'invalidTokenRedirect'));

        // pass shop and client
        $this->controller->injectClient($client, $shop);

        // save variables
        $event->getRequest()->attributes->set('_dream_commerce_shop_appstore_client', $client);
        $event->getRequest()->attributes->set('_dream_commerce_shop_appstore_shop', $shop);

    }


    /**
     * @param Event $event
     * @return null
     */
    protected function setController(Event $event)
    {
        /** @var Controller[] $controller */
        $controller = $event->getController();

        if (!is_array($controller)) {
            return null;
        }

        $this->controller = $controller[0];
    }

    /**
     * @param Event $event
     * @return null|Controller
     */
    protected function getController(Event $event)
    {
        return $this->controller;
    }

    protected function validateRequest(Request $request)
    {
        if (empty($this->controller)) {
            return;
        }

        try{
            if ($this->controller instanceof StandardApplicationControllerInterface) {
                $this->requestValidator = new RequestValidator\ApplicationRequestValidator($request, $this->applications);
                $this->payload = $this->requestValidator->validate();
            } elseif ($this->controller instanceof RestApplicationController) {
                $this->requestValidator = new RequestValidator\RestRequestValidator($request, $this->applications);
                $this->requestValidator->setShopRepository($this->shopRepository);
                $this->payload = $this->requestValidator->validate();
            }
        } catch(InvalidRequestException $ex) {
            throw new BadRequestHttpException(sprintf('Invalid request: "%s")', $ex->getMessage()), $ex);
        }
    }

    private function getShop(): ShopInterface
    {
        if (empty($this->requestValidator) || !($this->requestValidator instanceof RequestValidator\Types\RequestValidatorInterface)) {
            throw new InvalidRequestException('Method required existing request validator instance');
        }

        if ($this->controller instanceof StandardApplicationControllerInterface) {
            return $this->shopRepository->findOneByNameAndApplication($this->payload->getShop(), $this->requestValidator->getApplication()['name']);
        } elseif ($this->controller instanceof RestApplicationController) {
            return $this->requestValidator->getShop();
        }

        throw new InvalidRequestException('Unsupported request');
    }

    /**
     * redirect to error page info
     * @param FilterControllerEvent $event kept for backwards compatibility
     * @param $routeName
     */
    protected function redirect(FilterControllerEvent $event, $routeName){

        $route = $this->routes[$routeName];

        $url = $this->router->generate($route);

        throw new HttpException(307, null, null, array('Location' => $url));
    }

    /**
     * called when current token is invalid
     * @param ClientInterface $client
     * @param \Exception $ex
     */
    public function invalidTokenRedirect(ClientInterface $client, \Exception $ex){
        $this->redirect($this->lastEvent, 'reinstall');
    }

}