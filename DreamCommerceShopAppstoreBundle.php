<?php

namespace DreamCommerce\Bundle\ShopAppstoreBundle;

use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler\ApplicationsPass;
use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler\CustomObjectManagerPass;
use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler\DebuggerPass;
use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler\DoctrinePass;
use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler\WebhooksPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class DreamCommerceShopAppstoreBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // add Doctrine passes if available
        $this->addDoctrinePass($container);

        // verify and set object manager
        $container->addCompilerPass(new CustomObjectManagerPass(), PassConfig::TYPE_BEFORE_REMOVING);
        // instantiate a debugger is enabled
        $container->addCompilerPass(new DebuggerPass(), PassConfig::TYPE_BEFORE_REMOVING);
        // add applications services
        $container->addCompilerPass(new ApplicationsPass(), PassConfig::TYPE_BEFORE_REMOVING);
        // webhooks
        $container->addCompilerPass(new WebhooksPass(), PassConfig::TYPE_OPTIMIZE);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function addDoctrinePass(ContainerBuilder $container)
    {
        if (class_exists('\Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass')) {

            $mappings = array(
                realpath(__DIR__ . '/Resources/config/doctrine/model') => 'DreamCommerce\Bundle\ShopAppstoreBundle\Model'
            );

            // hint: DO NOT shorthand this import - it will screw up environments with no Doctrine installed
            $container->addCompilerPass(
                \Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass::createXmlMappingDriver($mappings)
            );
            $container->addCompilerPass(new DoctrinePass());
        }
    }
}
