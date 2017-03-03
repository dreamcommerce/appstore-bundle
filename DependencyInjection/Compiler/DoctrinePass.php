<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
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
        if($container->hasParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.orm')) {
            $this->mapInterfaces($container);
            $this->injectEntityManager($container);
        }
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function mapInterfaces(ContainerBuilder $container)
    {
        // map targeting entities to interfaces
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

        if (version_compare(\Doctrine\ORM\Version::VERSION, '2.5.0-DEV') < 0) {
            $def->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        } else {
            $def->addTag('doctrine.event_subscriber');
        }

        $container->setParameter(DreamCommerceShopAppstoreExtension::ALIAS . '.objects', $objects);
    }

    /**
     * @param ContainerBuilder $container
     */
    protected function injectEntityManager($container)
    {
        // adds entity manager name as argument for internal entity manager
        $def = $container->findDefinition('dream_commerce_shop_appstore.entity_manager');

        $ormOptions = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.orm');
        $def->setArguments([
            $ormOptions['entity_manager']
        ]);
    }

}