<?php

namespace JsSettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JsController extends Controller
{
    public function settingsAction()
    {
        $settings = $this->get('js_settings.settings')->getSettings();
        return $this->render('@JsSettings/settings.script.html.twig',
            array('settings' => $settings)
        );
    }
}
