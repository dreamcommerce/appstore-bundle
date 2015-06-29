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

        $rootNode
            ->children()
                ->arrayNode('applications')
                    ->requiresAtLeastOneElement()
                    ->prototype('array')
                        ->children()
                            ->scalarNode('app_id')->isRequired(true)->end()
                            ->scalarNode('app_secret')->isRequired(true)->end()
                            ->scalarNode('appstore_secret')->isRequired(true)->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('routes')
                    ->children()
                        ->scalarNode('unpaid')->defaultValue('dream_commerce_shop_appstore.unpaid')->end()
                        ->scalarNode('unsubscribed')->defaultValue('dream_commerce_shop_appstore.unsubscribed')->end()
                        ->scalarNode('not_installed')->defaultValue('dream_commerce_shop_appstore.not_installed')->end()
                        ->scalarNode('reinstall')->defaultValue('dream_commerce_shop_appstore.reinstall')->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
