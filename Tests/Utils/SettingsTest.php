<?php

use JsSettingsBundle\Utils\Settings;

/**
 * Class SettingsTest
 */
class SettingsTest extends PHPUnit_Framework_TestCase
{
    private $settings = null;

    public function setUp() {
        $defaults = [
            'object_name' => 'test_name',
            'defaults' => [
                'test' => 'test',
            ],
        ];
        $this->settings = new Settings($defaults);
    }

    public function tearDown() {
        $this->settings = null;
    }

    public function testConstruct()
    {
        // Defaults were set correctly.
        $defaults = $this->settings->getSettings();
        $this->assertTrue(in_array('test', $defaults));

        // Test name was set correctly.
        $name = $this->settings->getName();
        $this->assertEquals($name, 'test_name');
    }

    public function testGetSettings()
    {
        $settings = $this->settings->getSettings();
        $this->assertEquals(
            array('test' => 'test'),
            $settings
        );
    }

    public function testAddSettings()
    {
        $this->settings->addSettings('test_setting','test');
        $array = $this->settings->getSettings();

        $this->assertEquals(
            $array['test_setting'],
            'test'
        );
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
            'var test_name = {};test_name.settings = {"test":"test"}',
            $js
        );
    }

    public function testRenderJs()
    {
        $js = $this->settings->renderJs();

        $this->assertEquals(
            '<script>var test_name = {};test_name.settings = {"test":"test"}</script>',
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
