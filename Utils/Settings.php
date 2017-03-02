<?php

namespace IrishDan\JsSettingsBundle\Utils;

/**
 * Class Settings
 *
 * @package JsSettingsBundle\Utils
 */
/**
 * Class Settings
 *
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
     *
     * @param array $defaults
     */
    public function __construct(array $defaults)
    {
        if ( ! empty($defaults)) {
            if ( ! empty($defaults['object_name'])) {
                $this->setName($defaults['object_name']);
            }

            if ( ! empty($defaults['defaults'])) {
                foreach ($defaults['defaults'] as $key => $value) {
                    $this->settings[$key] = $value;
                }
            }
        }
    }

    /**
     * Push data into array that may already exist.
     *
     * @param $group
     * @param $key
     * @param $data
     * @return mixed
     */
    public function pushSettings($group, $key, $data)
    {
        if (empty($this->settings[$group])) {
            $this->settings[$group] = [];
        }

        if (empty($key)) {
            return $this->settings[$group][] = $data;
        }

        if (is_array($key)) {
            if (empty($this->settings[$group][$key[0]])) {
                $this->settings[$group][$key[0]] = [];
            }
            $this->settings[$group][$key[0]][$key[1]] = $data;
        } else {
            $this->settings[$group][$key] = $data;
        }
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add data to the JS array. Will override if already exists
     *
     * @param $key
     * @param $value
     */
    public function addSettings($key, $value)
    {
        $this->settings[$key] = $value;
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return string
     */
    public function getJs()
    {
        $name = $this->name;
        $settings = json_encode($this->getSettings());
        $js = 'var ' . $name . ' = {};' . $name . ' = ' . $settings;

        return $js;
    }

    /**
     * @param bool $script_tags
     * @return string
     */
    public function renderJs($script_tags = true)
    {
        $js = $this->getJs();
        if ($script_tags) {
            $js = '<script>' . $js . '</script>';
        }

        return $js;
    }

    /**
     * Delete all of the data
     */
    public function removeAllSettings()
    {
        $this->settings = [];
    }

    /**
     * @param $key
     */
    public function removeSetting($key)
    {
        if ( ! empty($this->settings[$key])) {
            unset($this->settings[$key]);
        }
    }
}