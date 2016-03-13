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
    private $settings = [];
    private $name = 'Symfony';

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

    public function addSettings($key, $value) {
        $this->settings[$key] = $value;
    }

    public function getSettings() {
        $name = $this->name;
        $settings = json_encode($this->settings);
        $js = 'var ' . $name . ' = {};' . $name . '.settings = ' . $settings;

        return $js;
    }

    public function renderSettings($script_tags = TRUE) {
        $js = $this->getSettings();
        if ($script_tags) {
            $js = '<script>' . $js . '</script>';
        }

        return $js;
    }
}