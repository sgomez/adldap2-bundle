<?php

namespace Sgomez\Bundle\Adldap2Bundle;

use Sgomez\Bundle\Adldap2Bundle\DependencyInjection\Adldap2Extension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Adldap2Bundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            return new Adldap2Extension();
        }
        return $this->extension;
    }
}
