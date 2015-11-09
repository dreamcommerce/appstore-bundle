<?php

namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DreamCommerceShopAppstoreExtension extends Extension
{

    const ALIAS = 'dream_commerce_shop_appstore';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter($this->getAlias().'.applications', $config['applications']);
        $container->setParameter($this->getAlias().'.routes', $config['routes']);

        $container->setParameter($this->getAlias().'.objects', $config['objects']);
        $container->setParameter($this->getAlias().'.object_manager', $config['object_manager']);

        $loader->load(sprintf('%s.yml', $config['db_driver']));

        if($config['db_driver']=='orm'){
            $container->setParameter($this->getAlias().'.orm', $config['orm']);
        }

        foreach($config['applications'] as $app=>$data){

            $definition = new Definition('DreamCommerce\\ShopAppstoreBundle\\Handler\\Application');
            $definition->addArgument($app);
            $definition->addArgument($data['app_id']);
            $definition->addArgument($data['app_secret']);
            $definition->addArgument($data['appstore_secret']);

            $container->setDefinition($this->getAlias().'.app.'.$app, $definition);
        }

    }

    public function getAlias(){
        return self::ALIAS;
    }
}
