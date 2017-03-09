<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\EventListener;


use Doctrine\Common\Persistence\ObjectManager;
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
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
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
     * @param FilterControllerEvent $event
     * @throws HttpException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        // last event used before token invalid exception is thrown
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

        // if latest controller on stack is a filtered instance
        if ($controller[0] instanceof ApplicationControllerInterface) {
            // get current request data
            $request = $event->getRequest();

            $requestValidator = new RequestValidator($request);

            try{
                // get parameters
                $appName = $requestValidator->getApplicationName($this->applications);
                $appData = $this->applications[$appName];
                $requestValidator->setApplication($appData);
                $params = $requestValidator->validateAppRequest();
            }catch(InvalidRequestException $ex){
                // if request is malformed
                throw new BadRequestHttpException('Invalid request');
            }

            // handle shop arguments on iframe (eg. product list checkboxes)
            if($request->query->has('id')){
                $ids = $request->query->get('id');
                $idsList = @json_decode($ids);
                $request->query->set('id', $idsList);
            }

            // search for installed shop instance by app
            /**
             * @var $repo ShopRepositoryInterface
             */
            $shop = $this->shopRepository->findOneByNameAndApplication($params['shop'], $appName);

            // not installed - throw an error
            if (!$shop || !$shop->getInstalled()){
                $this->redirect($event, 'not_installed');
            }

            // verify version requirements
            if($appData['minimal_version']>0){
                if($shop->getVersion()<$appData['minimal_version']){
                    $this->redirect($event, 'upgrade');
                }
            }

            // if an application controller needs to be paid
            if($controller[0] instanceof PaidControllerInterface){
                $billing = $shop->getBilling();
                if(empty($billing)){
                    $this->redirect($event, 'unpaid');
                }
            }

            // need a subscription?
            if($controller[0] instanceof SubscribedControllerInterface){
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
            $client = $this->applicationRegistry->get($appName)->getClient($shop);

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
            $controller[0]->injectClient($client, $shop);

            // save variables
            $event->getRequest()->attributes->set('_dream_commerce_shop_appstore_client', $client);
            $event->getRequest()->attributes->set('_dream_commerce_shop_appstore_shop', $shop);
        }
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