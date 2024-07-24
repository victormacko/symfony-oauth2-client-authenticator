<?php

namespace VictorMacko\AuthenticatorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('victormacko_authentication');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('client')->defaultValue('google')->end()
            ->arrayNode('roles')->prototype('scalar')->defaultValue(['ROLE_USER', 'ROLE_OAUTH_USER'])->end()->end()
            ->scalarNode('check_route')->defaultValue('connect_google_check')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}