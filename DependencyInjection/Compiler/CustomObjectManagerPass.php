<?php


namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection\Compiler;


use DreamCommerce\ShopAppstoreBundle\DependencyInjection\DreamCommerceShopAppstoreExtension;
use DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface;
use InvalidArgumentException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CustomObjectManagerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $objectManagerName = $container->getParameter(DreamCommerceShopAppstoreExtension::ALIAS.'.object_manager');
        if($objectManagerName){

            // if started with "@" like service definition
            $objectManagerName = $objectManagerName[0]=='@' ? substr($objectManagerName, 1) : $objectManagerName;

            $this->testObjectManager($container, $objectManagerName);
            $this->createObjectManagerDefinition($container, $objectManagerName);
        }
    }

    protected function testObjectManager(ContainerBuilder $container, $service){

        // test base interface implementation
        $def = $container->getDefinition($service);
        $class = $def->getClass();
        $interfaces = class_implements($class);

        if(!in_array('DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface', $interfaces)){
            throw new InvalidArgumentException('Specified object manager service class should implement DreamCommerce\ShopAppstoreBundle\Model\ObjectManagerInterface');
        }

        /**
         * @var $manager ObjectManagerInterface
         */
        $manager = $container->get($service);

        // test required repositories
        foreach(['Billing', 'Shop', 'Subscription', 'Token'] as $object){
            $objectInterfaceName = sprintf('DreamCommerce\ShopAppstoreBundle\Model\%sInterface', $object);

            // object
            $obj = $manager->create($objectInterfaceName);
            if(!$obj || !is_subclass_of($obj, $objectInterfaceName)){
                throw new InvalidArgumentException(sprintf('Specified object manager did not create %s instance correctly', $objectInterfaceName));
            }

            // repository
            $repo = $manager->getRepository($objectInterfaceName);
            $repoInterfaceName = sprintf('DreamCommerce\ShopAppstoreBundle\Model\%sRepositoryInterface', $object);
            if(!$repo || !is_subclass_of($repo, $repoInterfaceName)){
                throw new InvalidArgumentException(sprintf('Specified object manager did not return %s repository instance correctly - it does not implement %s', $objectInterfaceName, $repoInterfaceName));
            }
        }

    }

    protected function createObjectManagerDefinition(ContainerBuilder $container, $service){
        $container->setAlias(DreamCommerceShopAppstoreExtension::ALIAS.'.object_manager', $service);
    }
}