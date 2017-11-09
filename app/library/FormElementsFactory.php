<?php namespace Centinela;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Centinela\Models\Perfiles;

class FormElementsFactory
{
    public function nombre(){
        return $this->textRequired('nombre','Nombre','El nombre es requerido');
    }

    public function email(){
        return $this->emailValido('email','Email','Introduce un email válido');
    }

    public function userId(){
        $id = new Text('id',[
            'placeholder'=>'ID de usuario',
        ]);
        $id->setFilters('int');

        return $id;
    }

    public function password(){
        $message = 'El password debe tener al menos 8 caracteres';
        $password = new Password('password',[
            'placeholder'=>'Password',
            'pattern'=>'.{8,}',
        ]);
        $password->setUserOption('clientSide',$message);
        $password->addValidator(new StringLength([
            'min'=>8,
            'messageMinimum'=>$message,
        ]));
        $password->setUserOption('decorator','renderText');

        return $password;
    }

    public function confirmar(){
        $confirmar = new Password('confirmar',[
            'placeholder'=>'Confirmar password',
        ]);
        $confirmar->addValidator(new Confirmation([
            'message'=>'La Confirmacion no coincide con el Password',
            'with'=>'password',
        ]));
        $confirmar->setUserOption('decorator','renderText');

        return $confirmar;
    }

    public function perfiles(){
        // TODO implementar reglas segun los privilegios de usuario
        $perfiles = Perfiles::find([
            'activo = :activo:',
            'bind' => ['activo' => 1]
        ]);
        $selectPerfiles =  new Select('perfilId',$perfiles,[
            'using' => ['id','caption'],
        ]);
        $selectPerfiles->setDefault(4);
        $selectPerfiles->setUserOption('decorator','renderSelect');

        return $selectPerfiles;
    }

    public function bloqueado(){
        $bloqueado=new Check('bloqueado',[
            'value' => 1,
        ]);
        $bloqueado->setLabel('Usuario bloqueado');
        $bloqueado->setUserOption('decorator','renderCheck');

        return $bloqueado;
    }

    public function textRequired($name,$caption,$message){
        $element = new Text($name);
        $element->setUserOption('decorator','renderText');
        $this->configRequired($element,$caption,$message);

        return $element;
    }

    public function emailValido($name,$caption,$message)
    {
        $element = new Email($name);
        $element->setUserOption('decorator','renderText');
        $this->configEmail($element,$caption,$message);

        return $element;
    }

    private function configRequired($element,$caption,$message){
        $this->configDefault($element,$caption,$message);
        $element->addValidator(new PresenceOf([
            'message'=>$message
        ]));
    }

    private function configEmail($element,$caption,$message){
        $this->configDefault($element,$caption,$message);
        $element->addValidator(new EmailValidator([
            'message'=>$message
        ]));
    }

    private function configDefault($element,$caption,$message){
        $element->setAttributes([
            'placeholder'=>$caption,
            'required'=>true,
        ]);
        $element->setUserOption('clientSide',$message);
    }
}

