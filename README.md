# JsSettingsBundle

This bundle adds Drupal.settings functionality to symfony projects. Its a simple way of passing variables from PHP to Javascript.

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

In you config.yml you can add:
```php
js_settings:
    object_name: 'Drupal'
    defaults:
        local: "%locale%"
```

object_name: By default the Javascript object it Called 'Symfony.settings'. You can change the use 'Drupal.settings', by usingthe configuration above

Default values can be added to the object by passingin key values pairs to the defaults like above.  

4: Usage
---------------------------

The bundle provides a single service 'js_settings.settings'

To add variables simple pass in a key value pair, eg:
```php
$this->get('js_settings.settings')->addSettings('key', $values);
```

You need to print them in your templates. You can either include the provided controller in your template file, eg:
```php
{{ render(controller('JsSettingsBundle:Js:Settings')) }}
```

Or you can access pass them and print as you like:
```php
$settings = $this->get('js_settings.settings')->renderJs();
```

 