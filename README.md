# Adldap2 Integration for Symfony

This bundle helps you to use [adldap2](https://github.com/Adldap2/Adldap2) library with Symfony.

## Installation

### Step 1: Download the Bundle

Install the library via [Composer](https://getcomposer.org/) by
running the following command:

```bash
composer require sgomez/adldap2-bundle
```

### Step 2: Enable the Bundle

Next, enable the bundle in your `app/AppKernel.php` file:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Sgomez\Bundle\Adldap2Bundle\Adldap2Bundle(),
        // ...
    );
}
```

### Step 3: Configure the bundle

You need to configure your connection. The parameters are the same that use
 [Adldap2](https://github.com/Adldap2/Adldap2/blob/v5.2/docs/CONFIGURATION.md).
 
This is a sample configuration that you need to add in the `app/config/config.yml` file:

```yaml
adldap2:
    auto_connect: true
    connection_class: Adldap\Connections\Ldap
    connection_settings:
        domain_controllers: ["domain_controller_1", "domain_controller_2"]
        base_dn: "dc=domain,dc=com"
        admin_username: "username"
        admin_password: "password"
        account_suffix: "domain.com"
        port: 389
        follow_referrals: false
        use_ssl: false
        use_tls: false
        use_sso: false

```

You don't need to configure all values. See the original adldap2 documentation for more information.

### Step 4: Profit!

A new service called 'adldap2' has been created. It's a configured instance of [Adldap](https://github.com/Adldap2/Adldap2/blob/v5.2/src/Adldap.php)
 class. You can use it as usual:
 
```yaml

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->get('adldap2')->search()->find('username');
    }
}
```

## TODO

* UserProvider