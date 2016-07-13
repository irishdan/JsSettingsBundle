<?php

namespace JsSettingsBundle\Twig;


use JsSettingsBundle\Utils\Settings;

/**
 * Class JsSettingsExtension
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
        return array(
            new \Twig_SimpleFunction('get_js_settings', [$this, 'getSettings'], [
                'is_safe' => ['html']]),
        );
    }

    /**
     * @return string
     */
    public function getSettings()
    {
        return $this->settings->renderJs();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'js_settings_extension';
    }
}