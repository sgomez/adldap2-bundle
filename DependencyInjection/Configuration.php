<?php

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('adldap2');

        $rootNode
            ->children()
                ->arrayNode('connection_settings')
                    ->children()
                        ->arrayNode('domain_controllers')
                            ->prototype('scalar')->end()
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                        ->end()
                        ->integerNode('port')
                        ->end()
                        ->scalarNode('account_suffix')
                        ->end()
                        ->scalarNode('base_dn')
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                        ->end()
                        ->scalarNode('admin_username')
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                        ->end()
                        ->scalarNode('admin_password')
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                        ->end()
                        ->booleanNode('follow_referrals')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('use_ssl')
                            ->defaultFalse()
                        ->end()
                        ->booleanNode('use_tls')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

