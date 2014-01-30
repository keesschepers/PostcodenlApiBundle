<?php

namespace Keesschepers\PostcodenlApiBundle\DependencyInjection;

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
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('keesschepers_postcodenl_api');

        $rootNode
            ->children()
                ->scalarNode('base_url')
                    ->isRequired()
                ->end()
                ->scalarNode('timeout')
                    ->isRequired()
                ->end()
                ->scalarNode('api_user')
                    ->isRequired()
                ->end()
                ->scalarNode('api_secret')
                    ->isRequired()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
