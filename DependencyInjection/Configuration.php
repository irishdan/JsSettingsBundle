<?php
/**
 * Created by PhpStorm.
 * User: danielbyrne
 * Date: 12/03/2016
 * Time: 14:02
 */

namespace JsSettingsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('js_settings');
        $rootNode
            ->children()
                ->scalarNode('object_name')->end()
                ->arrayNode('defaults')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}