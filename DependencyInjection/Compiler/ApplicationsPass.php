<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use DreamCommerce\ShopAppstoreBundle\Handler\ApplicationRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class ApplicationsPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        // get applications configuration array
        $applications = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.applications');

        // create definition for application registry
        $applicationsDefinition = new Definition('DreamCommerce\ShopAppstoreBundle\Handler\ApplicationRegistry');

        // configuration for every app
        foreach($applications as $app=>$data){

            $definition = new Definition('DreamCommerce\\ShopAppstoreBundle\\Handler\\Application');
            $definition->addArgument($app);
            $definition->addArgument($data['app_id']);
            $definition->addArgument($data['app_secret']);
            $definition->addArgument($data['appstore_secret']);
            // if logger is instantiated, use it
            $definition->addArgument(
                new Reference(DreamCommerceShopAppstoreExtension::ALIAS.'.logger', ContainerInterface::NULL_ON_INVALID_REFERENCE)
            );

            $app = DreamCommerceShopAppstoreExtension::ALIAS . '.app.' . $app;

            // append definition
            $container->setDefinition($app, $definition);

            // add application to the registry
            $applicationsDefinition->addMethodCall('register', array(new Reference($app)));
        }

        // append applications registry to the container
        $container->setDefinition(DreamCommerceShopAppstoreExtension::ALIAS.'.apps', $applicationsDefinition);
    }
}