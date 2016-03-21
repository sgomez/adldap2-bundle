<?php

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;

use Adldap\Adldap;
use Adldap\Connections\ConnectionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\InvalidArgumentException;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class Adldap2Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $connectionClass = $config['connection_class'];
        if (!class_exists($connectionClass)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" not found.',
                $connectionClass
            ));
        }
        if (!new $connectionClass instanceof ConnectionInterface) {
            throw new InvalidArgumentException(sprintf(
                '"%s" must be an instance of "%s".',
                $connectionClass,
                ConnectionInterface::class
            ));
        }

        $autoConnect = $config['auto_connect'];
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
            $connectionSettings,
            $connectionClass,
            $autoConnect
        ]);
    }

    public function getAlias()
    {
        return 'adldap2';
    }
}
