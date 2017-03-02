<?php

namespace IrishDan\JsSettingsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class JsController
 *
 * @package JsSettingsBundle\Controller
 */
class JsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function settingsAction()
    {
        $settings = $this->get('js_settings.settings')->getJs();

        return $this->render('@JsSettings/settings.script.html.twig',
            ['settings' => $settings]
        );
    }
}
