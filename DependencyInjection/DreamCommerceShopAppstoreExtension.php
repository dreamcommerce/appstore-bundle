<?php

namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
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

        $xmlLoader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $xmlLoader->load('services.xml');

        $container->setParameter($this->getAlias().'.applications', $config['applications']);
        $container->setParameter($this->getAlias().'.routes', $config['routes']);

        $container->setParameter($this->getAlias().'.objects', $config['objects']);
        $container->setParameter($this->getAlias().'.object_manager', $config['object_manager']);

        if($config['db_driver']!='custom'){
            $xmlLoader->load(sprintf('%s.xml', $config['db_driver']));
        }

        if($config['db_driver']=='orm'){
            $container->setParameter($this->getAlias().'.orm', $config['orm']);
        }

        $container->setParameter($this->getAlias().'.debug', $config['debug']);

    }

    public function getAlias(){
        return self::ALIAS;
    }
}
