<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\WebhookValidator;


use DreamCommerce\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
use Symfony\Component\HttpFoundation\Request;

abstract class ValidatorAbstract implements ValidatorInterface
{

    /**
     * @var []
     */
    protected $events;

    /**
     * @var string
     */
    protected $secret;

    public function isEventSupported($event)
    {
        $events = new DreamCommerceShopAppstoreEvents();

        return
            in_array($event, $events->getSupportedWebhooks())
            &&
            in_array($event, $this->events);
    }

    public function isRequestValid(Request $request)
    {
        $hash = sha1(
            $request->headers->get('HTTP_X_WEBHOOK_ID') . ':' . $this->secret . ':' . $request->getContent()
        );

        return $hash==$request->headers->get('HTTP_X_WEBHOOK_SHA1');
    }
}