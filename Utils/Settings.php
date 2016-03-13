<?php
/**
 * Created by PhpStorm.
 * User: Daniel Byrne
 * Date: 12/03/2016
 * Time: 09:17
 */

namespace JsSettingsBundle\Utils;


class Settings
{
    /**
     * @var array
     */
    private $settings = [];
    /**
     * @var string
     */
    private $name = 'Symfony';

    /**
     * Settings constructor.
     * @param array $defaults
     */
    public function __construct(array $defaults)
    {
        if (!empty($defaults)) {
            if (!empty($defaults['object_name'])) {
                $this->name = $defaults['object_name'];
            }

            if (!empty($defaults['defaults'])) {
                foreach ($defaults['defaults'] as $key => $value) {
                    $this->settings[$key] = $value;
                }
            }
        }

    }

    /**
     * @param $key
     * @param $value
     */
    public function addSettings($key, $value) {
        $this->settings[$key] = $value;
    }

    /**
     * @return array
     */
    public function getSettings() {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getJs() {
        $name = $this->name;
        $settings = json_encode($this->getSettings());
        $js = 'var ' . $name . ' = {};' . $name . '.settings = ' . $settings;

        return $js;
    }

    /**
     * @param bool $script_tags
     * @return string
     */
    public function renderJs($script_tags = TRUE) {
        $js = $this->getJs();
        if ($script_tags) {
            $js = '<script>' . $js . '</script>';
        }

        return $js;
    }

    /**
     * @param $key
     */
    public function removeSetting($key) {
        if (!empty($this->settings[$key])) {
            unset($this->settings[$key]);
        }
     }
}