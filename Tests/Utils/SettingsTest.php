<?php

use JsSettingsBundle\Utils\Settings;

/**
 * Class SettingsTest
 */
class SettingsTest extends PHPUnit_Framework_TestCase
{
    private $settings;

    public function __construct($name = null, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $defaults = [
            'object_name' => 'test_name',
            'defaults' => [
                'test' => 'test',
            ],
        ];
        $this->settings = new Settings($defaults);
    }

    public function testConstructDefaults()
    {
        $defaults = $this->settings->getSettings();
        $this->assertTrue(in_array('test', $defaults));
    }

    public function testConstructObjectName()
    {
        $name = $this->settings->getName();
        $this->assertEquals($name, 'test_name');
    }

    public function testGetSettings()
    {
        $this->assertTrue(TRUE);
    }

    public function testAddSettings()
    {
        $this->settings->addSettings('test_setting','test');
        $array = $this->settings->getSettings();

        $this->assertTrue(in_array('test_setting', $array));
    }

    public function testSetName()
    {
        $this->settings->setName('new_test_name');

        $this->assertEquals(
            'new_test_name',
            $this->settings->getName()
        );
    }

    public function testGetJs()
    {
        $js = $this->settings->getJs();

        $this->assertEquals(
            '',
            $js
        );
    }

    public function testRenderJs()
    {
        $js = $this->settings->getJs();

        $this->assertEquals(
            '',
            $js
        );
    }

    public function testRemoveSetting()
    {
        $this->settings->removeSetting('test_setting');
        $array = $this->settings->getSettings();

        $this->assertTrue(!in_array('test_setting', $array));
    }

    public function testRemoveAllSettings()
    {
        $this->settings->removeAllSettings();
        $array = $this->settings->getSettings();

        $this->assertEquals(
            [],
            $array
        );
    }
}
