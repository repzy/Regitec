<?php

namespace Regitec\Controller;

use Regitec\Resources\Forms\SignForm;
use Regitec\Twig;
use Regitec\Entities\User;
use Regitec\DataMapper\UserMapper;
use Symfony\Component\HttpFoundation\Request;

class HomeController
{
    public function indexAction()
    {
        $twig = new Twig();
        echo $twig->getTwig()->render('index.html.twig');
    }

    public function profileAction($id)
    {
        $twig = new Twig();
        $mapper = new UserMapper();
        $entity = $mapper->getUser($id);
        echo $twig->getTwig()->render('profile.html.twig', array('entity' => $entity));
    }

    public function registrationAction()
    {
        $twig = new Twig();

        $signform = new SignForm();
        $form = $signform->getSignForm();

        echo $twig->getTwig()->render('registration.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function signUpAction()
    {
        $twig = new Twig();

        $signform = new SignForm();
        $form = $signform->getSignForm();

        $request = Request::createFromGlobals();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();

            $user = new User($data);
            $mapper = new UserMapper();
            $id = $mapper->saveUser($user);
            $entity = $mapper->getUser($id);
            echo $twig->getTwig()->render('profile.html.twig', array('entity' => $entity));
        }else{
            echo $twig->getTwig()->render('registration.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }
}