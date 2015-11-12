<?php

namespace DreamCommerce\ShopAppstoreBundle;

use DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler\ApplicationsPass;
use DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler\CustomObjectManagerPass;
use DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler\DebuggerPass;
use DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler\DoctrinePass;
use DreamCommerce\ShopAppstoreBundle\Utils\DebugProxy;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DreamCommerceShopAppstoreBundle extends Bundle
{

    public function boot(){

//        $debug = $this->container->getParameter('kernel.environment') == 'dev';
//
//        if($debug){
//            $this->enableLibraryDebugging();
//        }

    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $this->addDoctrinePass($container);

        $container->addCompilerPass(new CustomObjectManagerPass(), PassConfig::TYPE_BEFORE_REMOVING);
        $container->addCompilerPass(new DebuggerPass());
        $container->addCompilerPass(new ApplicationsPass());
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function addDoctrinePass(ContainerBuilder $container)
    {
        if (class_exists('\Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass')) {

            $mappings = array(
                realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DreamCommerce\ShopAppstoreBundle\Model'
            );

            $container->addCompilerPass(
                \Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass::createXmlMappingDriver($mappings)
            );
            $container->addCompilerPass(new DoctrinePass());
        }
    }
}
