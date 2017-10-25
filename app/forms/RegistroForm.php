<?php namespace Centinela\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Identical;

class RegistroForm extends Form
{
    public function initialize($entity = null,$option = null){
        //NOMBRE
        $nombre = new Text('nombre',[
            'placeholder'=>'Nombre',
            'class'=>'form-control',
            'required'=>true,
        ]);
        $nombre->setUserOption('clientSide','El nombre es requerido');
        $nombre->addValidator(new PresenceOf([
            'message'=>'El nombre es requerido'
        ]));
        $this->add($nombre);

        //EMAIL
        $email = new Email('email',[
            'placeholder'=>'email',
            'class'=>'form-control',
            'required'=>true,
        ]);
        $email->setUserOption('clientSide','Introduce un email válido');
        $email->addValidator(new EmailValidator([
            'message'=>'El email no es valido, verificalo e ingresalo correctamente'
        ]));
        $this->add($email);

        //PASSWORD
        $password = new Password('password',[
            'placeholder'=>'Password',
            'class'=>'form-control',
            'pattern'=>'.{8,}',
        ]);
        $password->setUserOption('clientSide','El password debe tener al menos '.
            '8 caracteres');
        $password->addValidator(new StringLength([
            'min'=>8,
            'messageMinimum'=>'El password debe tener al menos 8 caracteres',
        ]));
        $this->add($password);

        //CONFIRMAR
        $confirmar = new Password('confirmar',[
            'placeholder'=>'Confirmar password',
            'class'=>'form-control',
            'pattern'=>'.{8,}',
        ]);
        $confirmar->setUserOption('clientSide','El password debe tener al menos 8 '.
            'caracteres');
        $confirmar->addValidator(new Confirmation([
            'message'=>'La confirmacion no coincide con el password',
            'with'=>'password',
        ]));
        $this->add($confirmar);

        // Cross Site Request Forgery
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'Error de validacion (CSRF)',
        ]));
        $csrf->clear();
        $this->add($csrf);

        // BOTON REGISTRATE
        $this->add(new Submit('Registrar',[
            'class'=>'btn btn-outline-success btn-block'
        ]));
    }

    public function afterValidation(){
        foreach($this as $element){
            if($this->hasMessagesFor($element->getName())){
                $valid='is-invalid';
            }else{
                $valid='is-valid';
                $element->setUserOption('valid',true);
            }
            // Si no existe el atributo html 'class' retorna false
            $class = $element->getAttribute('class',false); 
            if($class){
                $element->setAttribute('class',"$class $valid");
            } else {
                $element->setAttribute('class',$valid);
            }
        }
    }

    public function renderInput($name){
        $element=$this->get($name);
        //Mensaje por defecto - client side
        $invalidMessage='Falta introducir este campo';
        if($this->hasMessagesFor($name)){
            $mensajes = $this->getMessagesFor($name);
            // Mensaje - server side
            $invalidMessage=$mensajes[0]->getMessage();
        }else{
            $invalidMessage = $element->getUserOption('clientSide',false) 
                ? $element->getUserOption('clientSide') : $invalidMessage;
        }
        if($element->getUserOption('valid',false) == true){
            $invalidMessage = '';
        }
        $render = $element->render();
        return <<<html
<div class="form-group">
  $render
  <div class="invalid-feedback">$invalidMessage</div>
</div>
html;
    }

    public function mensajes($name){
        if($this->hasMessagesFor($name)){
            foreach($this->getMessagesFor($name) as $message){
                $this->flash->error($message);
            }
        }
    }
}

