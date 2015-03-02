<?php

namespace Regitec;

use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Bridge\Twig\Extension\TranslationExtension;

class Twig {
    public function getTwig()
    {
        define('DEFAULT_FORM_THEME', 'form_div_layout.html.twig');
        define('VENDOR_DIR', realpath(__DIR__ . '/../vendor'));
        define('VENDOR_FORM_DIR', VENDOR_DIR . '/symfony/form/Symfony/Component/Form');
        define('VENDOR_VALIDATOR_DIR', VENDOR_DIR . '/symfony/validator/Symfony/Component/Validator');
        define('VENDOR_TWIG_BRIDGE_DIR', VENDOR_DIR . '/symfony/twig-bridge/Symfony/Bridge/Twig');
        define('VIEWS_DIR', realpath(__DIR__ . '/views'));

        $translator = new Translator('en');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource('xlf', VENDOR_FORM_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');
        $translator->addResource('xlf', VENDOR_VALIDATOR_DIR . '/Resources/translations/validators.en.xlf', 'en', 'validators');

        $twig = new \Twig_Environment(new \Twig_Loader_Filesystem(array(
            VIEWS_DIR,
            VENDOR_TWIG_BRIDGE_DIR . '/Resources/views/Form',
        )));
        $formEngine = new TwigRendererEngine(array(DEFAULT_FORM_THEME));
        $formEngine->setEnvironment($twig);
        $twig->addExtension(new TranslationExtension($translator));
        $twig->addExtension(new FormExtension(new TwigRenderer($formEngine)));


        return $twig;
    }
}