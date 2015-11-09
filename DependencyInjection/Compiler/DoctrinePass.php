<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use DreamCommerce\ShopAppstoreBundle\DreamCommerceShopAppstoreEvents;
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
        $this->addXmlMappings($container);
        $this->mapInterfaces($container);
        $this->injectEntityManager($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function addXmlMappings(ContainerBuilder $container)
    {
        $mappings = array(
            realpath(__DIR__ . '/../../Resources/config/doctrine/model') => 'DreamCommerce\ShopAppstoreBundle\Model'
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings));
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function mapInterfaces(ContainerBuilder $container)
    {
        $def = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        $objects = [];

        foreach ($container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS . '.objects') as $interface => $class) {

            $interface = 'DreamCommerce\ShopAppstoreBundle\Model\\' . ucfirst($interface).'Interface';

            $objects[$interface] = $class;

            $def->addMethodCall(
                'addResolveTargetEntity',
                array($interface, $class, [])
            );
        }

        $container->setParameter(DreamCommerceShopAppstoreExtension::ALIAS . '.objects', $objects);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function injectEntityManager($container)
    {
        $def = $container->findDefinition('dream_commerce_shop_appstore.entity_manager');

        $ormOptions = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.orm');
        $def->setArguments([
            $ormOptions['entity_manager']
        ]);
    }

}