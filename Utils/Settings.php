<?php
/**
 * Created by PhpStorm.
 * User: Daniel Byrne
 * Date: 12/03/2016
 * Time: 09:17
 */

namespace JsSettingsBundle\Utils;


/**
 * Class Settings
 * @package JsSettingsBundle\Utils
 */
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
                $this->setName($defaults['object_name']);
            }

            if (!empty($defaults['defaults'])) {
                foreach ($defaults['defaults'] as $key => $value) {
                    $this->settings[$key] = $value;
                }
            }
        }

    }

    /**
     * @param $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
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
     *
     */
    public function removeAllSettings() {
        $this->settings = [];
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