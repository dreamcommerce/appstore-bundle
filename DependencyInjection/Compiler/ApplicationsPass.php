<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;

class ApplicationsPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $applications = $container->get(DreamCommerceShopAppstoreExtension::ALIAS.'.applications');

        $debugger = $container->get(DreamCommerceShopAppstoreExtension::ALIAS.'.debugger', ContainerInterface::NULL_ON_INVALID_REFERENCE);

        foreach($applications as $app=>$data){

            $definition = new Definition('DreamCommerce\\ShopAppstoreBundle\\Handler\\Application');
            $definition->addArgument($app);
            $definition->addArgument($data['app_id']);
            $definition->addArgument($data['app_secret']);
            $definition->addArgument($data['appstore_secret']);
            if($debugger){
                $definition->addArgument($debugger);
            }

            $container->setDefinition(DreamCommerceShopAppstoreExtension::ALIAS.'.app.'.$app, $definition);
        }
    }
}