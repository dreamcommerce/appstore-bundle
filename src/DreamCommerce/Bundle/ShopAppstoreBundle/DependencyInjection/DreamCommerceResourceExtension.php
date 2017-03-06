<?php

namespace DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Parser;


/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class DreamCommerceResourceExtension extends AbstractResourceExtension
{

    const ALIAS = 'dream_commerce_shop_resources';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $locator = new FileLocator(__DIR__. '/../Resources/config');
        $yamlParser = new Parser();

        $config = $yamlParser->parse(file_get_contents($locator->locate('resources.yml')));
        $config = $this->processConfiguration(new ResourceConfiguration(), $config);

        $this->registerResources('dream_commerce', $config['driver'], $config['resources'], $container);
    }

    public function getAlias(){
        return self::ALIAS;
    }
}
