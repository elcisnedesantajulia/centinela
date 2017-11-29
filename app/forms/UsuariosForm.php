<?php
namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class UsuariosForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        // Factory instancia elementos reusables en varios formularios
        $factory = new Factory();
        $this->add($factory->nombre());
        $this->add($factory->email());

        if(!(isset($options['edit']) && $options['edit']))
        {
            $this->add($factory->userId()); //id
            $this->add($factory->password());
            $this->add($factory->confirmar());
        }

        $this->add($factory->perfiles());
        $this->add($factory->bloqueado());
    }
/*
    public function afterValidation2(){
        foreach($this as $element){
            if($this->hasMessagesFor($element->getName())){
                $element->setUserOption('valid','invalid');
            }else{
                $element->setUserOption('valid','valid');
            }
        }
    }
*/
}

