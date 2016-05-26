# JsSettingsBundle

This bundle adds Drupal.settings functionality to symfony projects. 
Its a simple way of passing variables from PHP to Javascript.

1: Installation
---------------------------

Clone the repo to your src directory.

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

            new JsSettingsBundle\JsSettingsBundle(),
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
    object_name: 'Drupal'
    defaults:
        local: "%locale%"
        page_data:
            site: 'www.example.com'
```

object_name: By default the Javascript object it Called 'Symfony.settings'. You can change the use 'Drupal.settings', by using the configuration above.

defaults: Default values are added to the javascript object by default and are always available. 

4: Usage
---------------------------

The bundle provides a single service 'js_settings.settings'. Using this service settings can can created, removed and accessed.

To add variables simple pass in a key value pair like so:
```php
$this->get('js_settings.settings')->addSettings('key', $values);
```

You need to print the javascript object in your templates. You can either include the provided controller in your template file, eg:
```php
{{ render(controller('JsSettingsBundle:Js:Settings')) }}
```

Or you can get them form the 'js_settings.settings' service and print as you like:

```php
$settings = $this->get('js_settings.settings')->renderJs();
```

 