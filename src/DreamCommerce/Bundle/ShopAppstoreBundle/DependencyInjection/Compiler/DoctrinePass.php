<?php


namespace DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\Compiler;



use DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class DoctrinePass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {

    }

    /**
     * @param ContainerBuilder $container
     */
    protected function mapInterfaces(ContainerBuilder $container)
    {
        // map targeting entities to interfaces

    }

    /**
     * @param ContainerBuilder $container
     */
    protected function injectEntityManager($container)
    {

    }

}