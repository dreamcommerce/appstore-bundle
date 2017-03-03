<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\Utils\Webhook\Validator;


use DreamCommerce\Bundle\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
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
            $request->headers->get('X-Webhook-Id') . ':' . $this->secret . ':' . $request->getContent()
        );

        return $hash==$request->headers->get('X-Webhook-Sha1');
    }
}