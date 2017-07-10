<?php

namespace IrishDan\JsSettingsBundle\Utils;

/**
 * Class Settings
 *
 * @package JsSettingsBundle\Utils
 */
use Symfony\Component\PropertyAccess\PropertyAccess;

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
    private $propertyAccessor;

    /**
     * Settings constructor.
     *
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
     * Pushes data into array that may already exist.
     *
     * @return mixed
     */
    public function pushData($key, $data)
    {
        $key = $this->formatKey($key);

        // Check data already exists
        $currentData = $this->propertyAccessor->getValue($this->settings, $key);
        if (empty($currentData)) {
            $this->propertyAccessor->setValue($this->settings, $key, [$data]);
        }
        else {
            // If the data is an array, just push data into the array.
            // if it's not make it into and array
            if (is_array($currentData)) {
                array_push($currentData, $data);
                $this->propertyAccessor->setValue($this->settings, $key, $currentData);
            }
            else {
                $this->propertyAccessor->setValue($this->settings, $key, [$currentData, $data]);
            }
        }
    }

    /**
     * Add data to the JS array. Will override if already exists
     *
     * @param $key
     * @param $value
     */
    public function addData($key, $value)
    {
        $key = $this->formatKey($key);

        // Just relpace the value if it exists.
        $this->propertyAccessor->setValue($this->settings, $key, $value);
    }

    protected function formatKey($key)
    {
        if ($this->propertyAccessor === null) {
            $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
        }

        // If it's an array convert it to a string with index notation separators.
        if (is_array($key)) {
            $key = implode('][', $key);
        }

        // Check if key is index notation format.
        // If its not index notation convert it.
        $indexNotation = preg_match("/^(\[[a-zA-Z0-9_]*\])*$/", $key, $matches);
        if (!$indexNotation) {
            $key = '[' . $key . ']';
        }

        return $key;
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
        $name     = $this->name;
        $settings = json_encode($this->getSettings());
        $js       = 'var ' . $name . ' = {};' . $name . ' = ' . $settings;

        return $js;
    }

    /**
     * @param bool $script_tags
     *
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
        if (!empty($this->settings[$key])) {
            unset($this->settings[$key]);
        }
    }
}