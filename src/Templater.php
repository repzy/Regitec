<?php

namespace Regitec;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;


class Templater
{
    public function getTemplate($file)
    {
        $loader = new FilesystemLoader(__DIR__.'/views/'.$file);

        $templating = new PhpEngine(new TemplateNameParser(), $loader);

        return $templating;
    }
}