# JsSettingsBundle

This bundle provides a service and a twig extension for easily injecting data into a webpage as a javascript object.

[![Build Status](https://travis-ci.org/irishdan/JsSettingsBundle.svg?branch=master)](https://travis-ci.org/irishdan/JsSettingsBundle)

1: Installation
---------------------------

Install with composer.
```
composer require irishdan/js-settings-bundle
```

Step 2: Enable the Bundle
-------------------------

Enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new IrishDan\JsSettingsBundle\JsSettingsBundle(),
        );
        // ...
    }
    // ...
}
```

Import the service definition in your config.yml file
imports:
```php
    - { resource: "@JsSettingsBundle/Resources/config/services.yml" }
```

3: Configuration
---------------------------

No configuration is needed. Some is available.

In config.yml you can add:
```php
js_settings:
    object_name: 'JsData'
    defaults:
        local: "%locale%"
        page_data:
            site: 'www.example.com'
```

object_name: By default the Javascript object it Called 'Symfony'. You can change the use 'JsData', by using the configuration above.

defaults: Default values are added to the javascript object by default and are always available. 

4: Usage
---------------------------

The bundle provides a single service 'js_settings.settings' to add data and remove data from the javascript object.

To add variables simple pass in a key value pair like so:
```php
// The key can be a string...
$this->get('js_settings.settings')->addData('key', $values);

// The key can be an array...
$this->get('js_settings.settings')->addData(['first_key', 'second_key'], $values);

// The key can be index notation
$this->get('js_settings.settings')->addData('[first_key][second_key]', $values);

```

Or, use pushData to push the data into an array.

```php
$this->get('js_settings.settings')->pushData('[first_key][second_key]', $values);
```

To inject the javascript object into the page, simply add the following twig function to your twig template

```php
{{ get_js_settings() }}
```



 