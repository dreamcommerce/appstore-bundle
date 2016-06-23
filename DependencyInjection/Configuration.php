<?php

namespace DreamCommerce\ShopAppstoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('dream_commerce_shop_appstore');

        $supportedDrivers = array('orm', 'custom');

        $rootNode
            ->children()
                ->scalarNode('debug')->defaultNull()->end() //false - disable debug completely; null - depends on kernel.debug. string - logger service
                ->scalarNode('skip_ssl')->defaultValue(false)->end()
                ->scalarNode('db_driver')
                    ->defaultValue('orm')
                    ->validate()
                        ->ifNotInArray($supportedDrivers)
                        ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
                    ->end()
                ->end()
                ->arrayNode('orm')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('entity_manager')->defaultValue('default')->end()
                    ->end()
                ->end()
                ->scalarNode('object_manager')->defaultNull()->end()
                ->arrayNode('objects')
                    ->children()
                        ->scalarNode('shop')->cannotBeEmpty()->end()
                        ->scalarNode('token')->cannotBeEmpty()->end()
                        ->scalarNode('billing')->cannotBeEmpty()->end()
                        ->scalarNode('subscription')->cannotBeEmpty()->end()
                    ->end()
                ->end()
                ->arrayNode('applications')
                    ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('app_id')->isRequired(true)->end()
                            ->scalarNode('app_secret')->isRequired(true)->end()
                            ->scalarNode('appstore_secret')->isRequired(true)->end()
                            ->scalarNode('minimal_version')->defaultNull()->end()
                            ->scalarNode('user_agent')->defaultNull()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('routes')->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('unpaid')->defaultValue('dream_commerce_shop_appstore.unpaid')->end()
                        ->scalarNode('unsubscribed')->defaultValue('dream_commerce_shop_appstore.unsubscribed')->end()
                        ->scalarNode('not_installed')->defaultValue('dream_commerce_shop_appstore.not_installed')->end()
                        ->scalarNode('reinstall')->defaultValue('dream_commerce_shop_appstore.reinstall')->end()
                        ->scalarNode('upgrade')->defaultValue('dream_commerce_shop_appstore.upgrade')->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
