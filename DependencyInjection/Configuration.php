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
                            ->scalarNode('appstore_secret')->isRequired(true)
                        ->end()
                    ->end()
                ->end()
            ->end();

        $rootNode
            ->children()
                ->arrayNode('classes')
                    ->children()
                        ->scalarNode('billing')
                            ->isRequired(true)
                            ->validate()
                                ->ifTrue(function($v){
                                    //return !class_exists($v) || !((new $v) instanceof \DreamCommerce\ShopAppstoreBundle\Model\BillingInterface);
                                })
                                ->thenInvalid('Billing class not existing or not implements BillingInterface')
                            ->end()
                        ->end()
                        ->scalarNode('shop')
                            ->isRequired(true)
                            ->validate()
                                ->ifTrue(function($v){
                                    //return !class_exists($v) || !((new $v) instanceof \DreamCommerce\ShopAppstoreBundle\Model\ShopInterface);
                                })
                                ->thenInvalid('Billing class not existing or not implements BillingInterface')
                            ->end()
                        ->end()
                        ->scalarNode('subscription')->isRequired(true)->end()
                        ->scalarNode('token')->isRequired(true)->end()
                    ->end()
                ->end()
            ->end();

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
