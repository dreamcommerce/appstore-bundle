<?php
namespace DreamCommerce\Bundle\ShopAppstoreBundle\Controller;

use DreamCommerce\Bundle\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\BillingInstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\InstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\SubscriptionEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\UninstallEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Event\Appstore\UpgradeEvent;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\AppstoreRequestValidator;
use DreamCommerce\Bundle\ShopAppstoreBundle\Utils\RequestValidator\InvalidRequestException;
use DreamCommerce\Component\ShopAppstore\Model\ApplicationPayload;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class ResponderController
 * responder for appstore events
 * @package DreamCommerce\Bundle\ShopAppstoreBundle\Controller
 */
class ResponderController extends Controller
{
    public function indexAction(Request $request)
    {
        // get applications configuration list
        $apps = $this->container->getParameter('dream_commerce_shop_appstore.apps');
        $validator = new AppstoreRequestValidator($request, $apps);
        $application = $validator->getApplication();

        try {
            $params = $validator->validate();
        } catch (InvalidRequestException $ex) {
            throw new BadRequestHttpException($ex->getMessage());
        }



        /**
         * @var $eventDispatcher EventDispatcher
         */
        $eventDispatcher = $this->get('event_dispatcher');

        switch($params->getAction()){
            case ApplicationPayload::ACTION_INSTALL:
                $event = new InstallEvent($application['name'], $application, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_INSTALLED, $event);
            break;

            case ApplicationPayload::ACTION_BILLING_INSTALL:
                $event = new BillingInstallEvent($application['name'], $application, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_PAID, $event);
                break;

            case ApplicationPayload::ACTION_SUBSCRIPTION:
                $event = new SubscriptionEvent($application['name'], $application, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_SUBSCRIPTION, $event);
                break;

            case ApplicationPayload::ACTION_UNINSTALL:
                $event = new UninstallEvent($application['name'], $application, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_UNINSTALLED, $event);
            break;

            case ApplicationPayload::ACTION_UPGRADE:
                $event = new UpgradeEvent($application['name'], $application, $params);
                $eventDispatcher->dispatch(DreamCommerceShopAppstoreEvents::APPLICATION_UPGRADED, $event);
            break;

            default:
                throw new \HttpInvalidParamException('Unsupported action');
        }

        return new Response();

    }
}
