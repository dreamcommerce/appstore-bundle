<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils;


use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\WebhookProcessor\Exception;
use DreamCommerce\ShopAppstoreBundle\Utils\WebhookValidator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;

class WebhookProcessor
{

    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    /**
     * @var ShopInterface
     */
    protected $shop;

    public function __construct(EventDispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }

    public function process(ValidatorInterface $validator, Request $request){

        $eventName = $request->headers->get('HTTP_X_WEBHOOK_NAME');

        if ($validator->isEventSupported($eventName)) {
            throw new Exception(sprintf('"%s" event is not supported', $eventName));
        }

        $mime = $request->headers->get('Content-Type');
        $mime = explode('; ', $mime)[0];
        $mime = explode('/', $mime)[1];

        if (!in_array($mime, ['json', 'xml'])) {
            throw new Exception('Invalid webhook payload format');
        }

        $body = $request->getContent();

        if (!$body) {
            throw new Exception('Empty payload');
        }

        if ($mime == 'json') {
            $body = @json_decode($body);
        } else {
            $body = @simplexml_load_string($body);
        }

        if (!$body) {
            throw new Exception('Malformed payload');
        }

        $eventName = preg_replace('#[^a-z\.]#si', '', $eventName);

        $className = explode('.', $eventName);
        $className = array_map('ucfirst', $className);
        $className[] = 'Event';

        $fqdn = sprintf('DreamCommerce\\ShopAppstoreBundle\\Event\\Webhook\\%s', implode('', $className));

        $class = new $fqdn($body, $this->shop);

        $this->dispatcher->dispatch(sprintf('dream_commerce_shop_appstore.webhook.%s', $eventName), $class);
    }
    
}