<?php

namespace Regitec\Resources\Forms;

use Regitec\Form;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class SignForm
{
    public function getSignForm()
    {
        $form = new Form();

        $signform = $form->createFormFactory()->createBuilder('form')
            ->add('firstname', 'text', array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array(
                        'min'        => 2,
                        'max'        => 50,
                        'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters long',
                    ))
                )
            ))
            ->add('lastname', 'text', array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array(
                        'min'        => 2,
                        'max'        => 50,
                        'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters long',
                    ))
                )
            ))
            ->add('patronymic', 'text', array(
                'constraints' => array(
                    new NotBlank(),
                    new Length(array(
                        'min'        => 2,
                        'max'        => 50,
                        'minMessage' => 'Your first name must be at least {{ limit }} characters long',
                        'maxMessage' => 'Your first name cannot be longer than {{ limit }} characters long',
                    ))
                )
            ))
            ->add('password', 'repeated', array(
                    'constraints' => array(
                        new NotBlank(),
                        new GreaterThan(array('value' => 3)
                        )),
                    'type' => 'password',
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                )
            )
            ->add('email', 'email', array(
                'constraints' => array(
                    new NotBlank(),
                    new Email()
                )
            ))
            ->add('phone', 'text', array(
                'constraints' => array(
                    new NotBlank(),
                    new Regex(array(
                        'pattern' => '/^((8|\+3)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/'
                    ))
                )
            ))
            ->add('avatar', 'file', array(
                'constraints' => array(
                    new Image(array(
                        'minWidth' => 500,
                        'maxWidth' => 500,
                        'minHeight' => 500,
                        'maxHeight' => 500,
                    ))
                )
            ))
            ->getForm();

        return $signform;
    }
}