<?php
/**
 * Created by PhpStorm.
 * User: danielbyrne
 * Date: 12/03/2016
 * Time: 14:06
 */

namespace JsSettingsBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class JsSettingsExtension
 * @package JsSettingsBundle\DependencyInjection
 */
class JsSettingsExtension extends Extension
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        // Set defaults from config.yml.
        $container->setParameter('js_settings', []);
        foreach (['defaults', 'object_name'] as $attribute) {
            if (empty($config[$attribute])) {
                $config[$attribute] = NULL;
            }
        }
        $container->setParameter('js_settings', $config);
    }
}