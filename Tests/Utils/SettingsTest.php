<?php

/**
 * Class SettingsTest
 */
class SettingsTest extends PHPUnit_Framework_TestCase
{
    private $settings = null;

    public function setUp()
    {
        $defaults       = [
            'object_name' => 'test_name',
            'defaults'    => [
                'test' => 'test',
            ],
        ];
        $this->settings = new \IrishDan\JsSettingsBundle\Utils\Settings($defaults);
    }

    public function tearDown()
    {
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
            ['test' => 'test'],
            $settings
        );
    }

    public function testKeyFormats()
    {
        $keyIndexNotation = '[first_key][last_key]';
        $keyArray         = [
            'first_key',
            'last_key',
        ];
        $keyString        = 'string_key';

        // Index notation
        $this->settings->addData($keyIndexNotation, 'indexNotationData');
        $result = $this->settings->getSettings();

        $this->assertEquals('indexNotationData', $result['first_key']['last_key']);

        // Array of keys
        $this->settings->addData($keyArray, 'arrayKeyData');
        $result = $this->settings->getSettings();

        $this->assertEquals('arrayKeyData', $result['first_key']['last_key']);

        // Simple string.
        $this->settings->addData($keyString, 'stringKeyData');
        $result = $this->settings->getSettings();

        $this->assertEquals('stringKeyData', $result['string_key']);
    }

    public function testAddData()
    {
        $this->settings->addData('test_setting', 'test');
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
            'var test_name = {};test_name = {"test":"test"}',
            $js
        );
    }

    public function testRenderJs()
    {
        $js = $this->settings->renderJs();

        $this->assertEquals(
            '<script>var test_name = {};test_name = {"test":"test"}</script>',
            $js
        );
    }

    public function testRemoveSetting()
    {
        $this->settings->removeSetting('test_setting');
        $array = $this->settings->getSettings();

        $this->assertTrue(!in_array('test_setting', $array));
    }

    public function testPushData()
    {
        $key   = '[first][second]';
        $data1 = ['an' => 'array'];
        $data2 = 'a_nice_string';

        $this->settings->pushData($key, $data1);
        $this->settings->pushData($key, $data2);

        $js = $this->settings->getSettings();

        $this->assertTrue(is_array($js['first']['second']));
        $this->assertEquals(['an' => 'array'], $js['first']['second'][0]);
        $this->assertEquals('a_nice_string', $js['first']['second'][1]);
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
