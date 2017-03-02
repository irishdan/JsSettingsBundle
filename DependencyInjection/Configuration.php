<?php

namespace IrishDan\JsSettingsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


/**
 * Class Configuration
 *
 * @package JsSettingsBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('js_settings');
        $rootNode
            ->children()
            ->scalarNode('object_name')->end()
            ->variableNode('defaults')->end()
            ->end();

        return $treeBuilder;
    }
}