<?php

namespace Time\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Email as EmailText;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{
    public function initialize()
    {
        // Email
        $email = new EmailText('email', [
            'placeholder' => 'Email',
            'required' => 'required'
        ]);
        $email->setLabel('Email');
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Password('password', [
            'placeholder' => 'Password',
            'required' => 'required'
        ]);
        $password->setLabel('Password');
        $password->addValidator(new PresenceOf([
            'message' => 'The password is required'
        ]));
        $password->clear();
        $this->add($password);

        $this->add(new Submit('go',[
            'value' => "Sign in"
        ]));
    }
}