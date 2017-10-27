<?php
namespace Centinela\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Password;
//use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Centinela\Models\Perfiles;
use Centinela\FormElementsFactory as Factory;

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
        $this->add($sel_perfiles);
        
        $bloqueado=new Check('bloqueado',[
            'class'=>'form-check-input',
        ]);
        $bloqueado->setLabel('Selecciona para bloquear');
        $this->add($bloqueado);
    }

    public function renderInput($name){
        $element=$this->get($name);
        //Mensaje por defecto - client side
/*        $invalidMessage='Falta introducir este campo';
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
*/
        $render = $element->render();
        return <<<html
<div class="form-group">
  $render
  <!--div class="invalid-feedback">invalidMessage</div-->
</div>
html;
    }

    public function renderSelectAsRadio($name){
        $element=$this->get($name);

        $opts = $element->getOptions();
        $value = $element->getValue();
//var_dump($value); exit;
        $html_opts='';
        foreach ($opts as $op_label) {
            $id = $op_label->id;
            $checked = ($id == $value) ? 'checked' : '' ;
            $active = ($id == $value) ? 'active' : '' ;
//var_dump($op_value); exit;
            $caption = $op_label->caption;
            $html_opts.=<<<html
<label class="btn btn-outline-info $active">
    <input type="radio" name="$name" value="$id" $checked id="$id" autocomplete="off"/>
        $caption<br/>
</label>
html;
        
        }

        return <<<html
<div class="btn-group" data-toggle="buttons">
  $html_opts
</div>
html;
    }

    public function renderSelect($name){
        $element=$this->get($name);
        $render = $element->render();
        return <<<html
<div class="form-group">
  $render
</div>
html;
    }

    public function renderCheck($name){
        $element=$this->get($name);
        $render = $element->render();
        $label = $element->getLabel();
return <<<html
<div class="form-check">
  <label class="form-check-label">
    $render
    $label
  </label>
</div>
html;
    }

/*
    public function mensajes($name){
        if($this->hasMessagesFor($name)){
            foreach($this->getMessagesFor($name) as $message){
                $this->flash->error($message);
            }
        }
    }
*/
}

