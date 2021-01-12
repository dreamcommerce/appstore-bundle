<?php


namespace DreamCommerce\ShopAppstoreBundle\Utils\Webhook;


use DreamCommerce\ShopAppstoreBundle\Event\Webhook\EventAbstract;
use DreamCommerce\ShopAppstoreBundle\Handler\Application;
use DreamCommerce\ShopAppstoreBundle\Model\ShopInterface;
use DreamCommerce\ShopAppstoreBundle\Model\ShopRepositoryInterface;
use DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Processor\Exception;
use DreamCommerce\ShopAppstoreBundle\Utils\Webhook\Validator\ValidatorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;

class Processor
{
    /**
     * @var ShopInterface
     */
    protected $shop;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * @var Application
     */
    protected $application;
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function setShop(ShopInterface $shop)
    {
        $this->shop = $shop;
    }

    public function process(ValidatorInterface $validator, Request $request){

        $eventName = $request->headers->get('X-Webhook-Name');

        if (!$validator->isEventSupported($eventName)) {
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

        $className = explode('.', $eventName, 2);
        $className = array_map('ucfirst', $className);
        $className[] = 'Event';

        $fqcn = sprintf('DreamCommerce\\ShopAppstoreBundle\\Event\\Webhook\\%s', implode('', $className));

        if(!class_exists($fqcn)){
            throw new Exception(sprintf('Class %s not found', $fqcn));
        }

        /**
         * @var $class EventAbstract
         */
        $class = new $fqcn($body, $this->shop, $this->application);

        $this->dispatcher->dispatch($class);
    }

    /**
     * @param Application $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }

}