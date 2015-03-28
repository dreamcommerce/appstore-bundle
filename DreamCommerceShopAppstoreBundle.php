<?php

namespace DreamCommerce\ShopAppstoreBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DreamCommerce\ShopAppstoreBundle\Utils\DebugProxy;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DreamCommerceShopAppstoreBundle extends Bundle
{

    public function boot(){

        $debug = $this->container->getParameter('kernel.environment') == 'dev';

        if($debug){
            $this->enableLibraryDebugging();
        }

    }

    public function build(ContainerBuilder $container)
    {
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DreamCommerce\ShopAppstoreBundle\Model'
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings));
    }

    protected function enableLibraryDebugging()
    {
        /**
         * @var $logger LoggerInterface
         */
        $loggerName = $this->container->getParameter('dream_commerce_shop_appstore.logger');
        $logger = $this->container->get($loggerName);

        DebugProxy::setLogger($logger);

        stream_register_wrapper('dreamcommercelogger', 'DreamCommerce\ShopAppstoreBundle\Utils\DebugProxy');

        define('DREAMCOMMERCE_DEBUG', true);
        define('DREAMCOMMERCE_LOG_FILE', 'dreamcommercelogger://debug');
    }

}
