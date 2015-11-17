<?php

namespace DreamCommerce\ShopAppstoreBundle\Controller;

use DreamCommerce\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator;
use DreamCommerce\ShopAppstoreBundle\Utils\RequestValidator\InvalidRequestException;
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
        $apps = $this->container->getParameter('dream_commerce_shop_appstore.applications');

        $validator = new RequestValidator($request);

        try {
            // validate application settings
            $appName = $validator->getApplicationName($apps);
            $validator->setApplication($apps[$appName]);
            $params = $validator->validateAppstoreRequest();
        }catch (InvalidRequestException $ex){
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
}
