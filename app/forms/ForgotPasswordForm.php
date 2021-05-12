<?php



//namespace Vokuro\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Email as EmailText;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


/**
 * Vokuro\Forms\ForgotPasswordForm
 * @package Vokuro\Forms
 */
class ForgotPasswordForm extends Form
{

    public function initialize()
    {
        $email = new EmailText('email', [
            'placeholder' => 'Provide your email',
            'required' => 'Required'
        ]);

        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);

        $this->add($email);

        $this->add(new Submit('Send'));
    }
}
