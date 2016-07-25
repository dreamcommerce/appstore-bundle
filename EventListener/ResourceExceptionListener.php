<?php


namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreLib\Resource\Exception\ResourceException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Event\ConsoleExceptionEvent;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ResourceExceptionListener
{

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {

        $this->logger = $logger;
    }

    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        $ex = $event->getException();
        $this->handleException($ex);
    }

    public function handleException(\Exception $ex){

        if(!($ex instanceof ResourceException)){
            return;
        }

        $httpException = $ex->getPrevious();

        $this->logger->error($ex->getMessage(), [(string)$httpException]);
    }

    public function onAppException(GetResponseForExceptionEvent $event)
    {
        $ex = $event->getException();
        $this->handleException($ex);
    }
}