<?php namespace Centinela\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends Form
{
    const AUTH_ERROR_MSG = 'Email o password no válidos';
    
    public function initialize(){
        // EMAIL
        $email = new Text('email', [
            'placeholder' => 'email'
        ]);
        $email->addValidator(new Email([
            'message' => self::AUTH_ERROR_MSG,
        ]));
        $this->add($email);

        // PASSWORD
        $password = new Password('password', [
            'placeholder' => 'Password'
        ]);
        $password->addValidator(new StringLength([
            'min' => 8,
            'messageMinimum' => self::AUTH_ERROR_MSG,
        ]));
        $password->clear();
        $this->add($password);

        // Cross Site Request Forgery
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'Error de validacion (CSRF)'
        ]));
        $csrf->clear();
        $this->add($csrf);

        // BOTON ENTRAR
        $this->add(new Submit('Ingresar'));
    }
}

