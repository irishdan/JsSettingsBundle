<?php

namespace IrishDan\JsSettingsBundle\Twig;

use IrishDan\JsSettingsBundle\Utils\Settings;

/**
 * Class JsSettingsExtension
 *
 * @package JsSettingsBundle\Twig
 */
class JsSettingsExtension extends \Twig_Extension
{
    /**
     * @var Settings
     */
    private $settings;

    /**
     * JsSettingsExtension constructor.
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'get_js_settings', [$this, 'getSettings'], [
                    'is_safe'           => ['html'],
                    'needs_environment' => true,
                ]
            ),
        ];
    }

    /**
     * @return string
     */
    public function getSettings(\Twig_Environment $environment)
    {
        return $environment->render(
            'JsSettingsBundle::settings.script.html.twig',
            [
                'settings' => $this->settings->renderJs(),
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'js_settings_extension';
    }
}