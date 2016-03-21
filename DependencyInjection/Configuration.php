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
                ->booleanNode('auto_connect')
                    ->defaultTrue()
                ->end()
                ->scalarNode('connection_class')
                    ->defaultValue('Adldap\Connections\Ldap')
                ->end()
                ->arrayNode('connection_settings')
                    ->children()
                        ->arrayNode('domain_controllers')
                            ->prototype('scalar')->end()
                            ->isRequired(true)
                            ->cannotBeEmpty()
                        ->end()
                        ->integerNode('port')
                        ->end()
                        ->scalarNode('account_suffix')
                        ->end()
                        ->scalarNode('base_dn')
                            ->isRequired(true)
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('admin_username')
                            ->isRequired(true)
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('admin_password')
                            ->isRequired(true)
                            ->cannotBeEmpty()
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
                        ->booleanNode('use_sso')
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

