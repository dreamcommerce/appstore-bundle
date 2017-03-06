<?php

namespace DreamCommerce\Bundle\ShopAppstoreBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class ResourceConfiguration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();


        $rootNode = $treeBuilder->root('dream_commerce_shop_appstore1');

        $rootNode->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')
                    ->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)
                ->end()
            ->end()
            ->children()
                ->arrayNode('resources')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('classes')
                                ->children()
                                    ->scalarNode('model')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('interface')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}