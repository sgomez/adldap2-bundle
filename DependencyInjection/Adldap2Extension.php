<?php

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;

use Adldap\Adldap;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class Adldap2Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);


        $connectionSettings = $config['connection_settings'];
        if (!empty($connectionSettings['account_suffix'])) {
            $connectionSettings['account_suffix'] = '@'.$connectionSettings['account_suffix'];
        }

        $service = $container->register('adldap2', Adldap::class);
        $service->setFactory([
            Adldap2Factory::class,
            'createConnection'
        ]);
        $service->setArguments([
            $connectionSettings
        ]);
    }

    public function getAlias()
    {
        return 'adldap2';
    }
}
