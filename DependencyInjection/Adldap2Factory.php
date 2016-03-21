<?php
/*
 * This file is part of the sigu.
 *
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sgomez\Bundle\Adldap2Bundle\DependencyInjection;


use Adldap\Adldap;

class Adldap2Factory
{
    public function createConnection(array $config, $connectionClass, $autoConnect)
    {
        return new Adldap($config, new $connectionClass, $autoConnect);
    }
}