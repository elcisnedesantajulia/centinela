<?php
namespace Centinela\Forms;

//use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
//use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
//use Phalcon\Validation\Validator\PresenceOf;
//use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Centinela\Models\Perfiles;
use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class UsuariosForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        //Durante la edicion el id se oculta
        if( isset($options['edit']) && $options['edit'] ){
            $id = new Hidden('id');
        }else{
            $id = new Text('id',[
                'placeholder'=>'ID del usuario'
            ]);
        }
        $this->add($id);

        // Instancia elementos reusables en varios formularios
        $factory = new Factory(); //Por defecto inline es false
        // Elemento inline reusable con parametros customizados
        $this->add($factory->nombre());
        $this->add($factory->email());

        if(!(isset($options['edit']) && $options['edit']))
        {
            // PASSWORD
            $password = new Password('password',[
                'placeholder'=>'Password',
                'class'=>'form-control',
                'pattern'=>'.{8,}',
            ]);
            $password->setUserOption(
                'clientSide',
                'El password debe tener al menos 8 caracteres'
            );
            $password->addValidator(new StringLength([
                'min'=>8,
                'messageMinimum'=>'El Password debe tener al menos 8 caracteres',
            ]));
            $this->add($password);
    
            //CONFIRMAR
            $confirmar = new Password('confirmar');
            $confirmar->setUserOption(
                'clientSide',
                'El password debe tener al menos 8 caracteres'
            );
            $confirmar->addValidator(new Confirmation([
                'message'=>'La Confirmacion no coincide con el Password',
                'with'=>'password',
            ]));
            $this->add($confirmar);
        }

        //ID PERFIL
        $perfiles = Perfiles::find([
            'activo = :activo:',
            'bind' => ['activo' => 1]
        ]);
        $sel_perfiles=new Select('perfilId',$perfiles,[
            'using' => ['id','caption'],
//            'useEmpty'=>true,
//            'emptyText'=>'Perfil',
//            'emptyValue'=>'',
            'class'=>'form-control'
        ]);
        $this->add($factory->perfiles());
        
        $bloqueado=new Check('bloqueado',[
            'class'=>'form-check-input',
        ]);
        $bloqueado->setLabel('Selecciona para bloquear');
        $this->add($bloqueado);
    }
}

