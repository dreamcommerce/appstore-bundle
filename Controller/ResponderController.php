<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use Doctrine\Common\Persistence\ObjectManager;
use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use DreamCommerce\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;
use DreamCommerce\ShopAppstoreBundle\Model\ShopRepositoryInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator\InvalidRequestException;
use DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Validator\AppValidatorInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Validator\GlobalValidatorInterface;
use DreamCommerce\ShopAppstoreLib\Resource\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class ResponderController
 * responder for appstore events
 * @package DreamCommerce\ShopAppstoreBundle\Controller
 */
class ResponderController extends Controller
{

    public function indexAction(Request $request)
    {

        // get applications configuration list
        $apps = $this->container->getParameter('dream_commerce_shop_appstore.apps');

        $validator = new RequestValidator($request);

        try {
            // validate application settings
            $appName = $validator->getApplicationName($apps);
            $validator->setApplication($apps[$appName]);
            $params = $validator->validateAppstoreRequest();
        } catch (InvalidRequestException $ex) {
            throw new BadRequestHttpException($ex->getMessage());
        }

        /**
         * @var $eventDispatcher EventDispatcher
         */
        $eventDispatcher = $this->get('event_dispatcher');

        // dispatch appstore action
        switch($params['action']){
            case 'install':
                $event = new InstallEvent($appName, $apps[$appName], $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_INSTALLED, $event);
                break;

            case 'billing_install':
                $event = new BillingInstallEvent($appName, $apps[$appName], $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_PAID, $event);
                break;

            case 'billing_subscription':
                $event = new SubscriptionEvent($appName, $apps[$appName], $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_SUBSCRIPTION, $event);
                break;

            case 'uninstall':
                $event = new UninstallEvent($appName, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_UNINSTALLED, $event);
                break;

            case 'upgrade':
                $event = new UpgradeEvent($appName, $apps[$appName], $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_UPGRADED, $event);
                break;

            default:
                throw new \HttpInvalidParamException('Unsupported action');
        }

        return new Response();

    }

    public function globalWebhookAction($webhookId, Request $request)
    {

        $definedWebhooks = $this->getParameter('dream_commerce_shop_appstore.webhooks');

        if (!isset($definedWebhooks[$webhookId])) {
            throw new \Exception(sprintf('Webhook ID "%s" not found', $webhookId));
        }

        $webhookData = $definedWebhooks[$webhookId];

        /**
         * @var $validator GlobalValidatorInterface
         */
        $validator = $this->get($webhookData['validator']);
        $validator->setConfig($webhookData);

        $processor = $this->get('dream_commerce_shop_appstore.webhook.processor');
        $processor->process($validator, $request);

        return new Response();
    }

    public function applicationWebhookAction($appId, $webhookId, Request $request)
    {
        $apps = $this->get('dream_commerce_shop_appstore.apps');

        $app = $apps->get($appId);
        if(!$app){
            throw new NotFoundException(sprintf('Application %s not found', $appId));
        }

        $webhookData = $app->getWebhook($webhookId);
        if(!$webhookData){
            throw new NotFoundException(sprintf('Webhook %d not found', $webhookId));
        }

        /**
         * @var $om ObjectManager
         */
        $om = $this->get(DreamCommerceShopAppstoreExtension::ALIAS . '.object_manager');
        /**
         * @var $repo ShopRepositoryInterface
         */
        $repo = $om->getRepository('DreamCommerce\ShopAppstoreBundle\Model\ShopInterface');

        $shopName = $request->headers->get('HTTP_X_SHOP_LICENSE');
        $shop = $repo->findOneByNameAndApplication($shopName, $appId);
        if(!$shop){
            throw new NotFoundException(sprintf('Shop %s not found', $shopName));
        }

        /**
         * @var $validator AppValidatorInterface
         */
        $validator = $this->get($webhookData['validator']);
        $validator->setConfig($app, $webhookId);
        $validator->setShop($shop);

        $processor = $this->get('dream_commerce_shop_appstore.webhook.processor');
        $processor->setShop($shop);
        $processor->process($validator, $request);

        return new Response();
    }
}
