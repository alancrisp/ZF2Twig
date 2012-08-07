ZF2Twig
=======

Integrates Twig template engine into Zend Framework 2.

Installation
------------

Enable ZF2Twig in config/application.config.php to begin using.

Configuration
-------------

All configuration for ZF2Twig resides within the `zf2twig` configuration key.

```php
'zf2twig' => array(
    'default_suffix' => 'twig', // default suffix for twig template files
    'environment_options' => array(
        // any ordinary twig configuration
        'cache' => '/path/to/compilation_cache',
    ),
    'extensions' => array(
        // extension classes, loaded from service manager
    ),
),
```
