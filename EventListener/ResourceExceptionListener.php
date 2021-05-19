<?php


namespace DreamCommerce\ShopAppstoreBundle\EventListener;


use DreamCommerce\ShopAppstoreLib\Resource\Exception\ResourceException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;


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

    public function onConsoleException(ExceptionEvent $event)
    {
        $ex = $event->getThrowable();
        $this->handleException($ex);
    }

    public function handleException(\Throwable $ex){

        if(!($ex instanceof ResourceException)){
            return;
        }

        $httpException = $ex->getPrevious();

        $this->logger->error($ex->getMessage(), [(string)$httpException]);
    }

}