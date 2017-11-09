<?php
namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class RegistroForm extends Form
{
    public function initialize($entity=null,$options=null){

        // Factory instancia elementos reusables en varios formularios
        $factory = new Factory();
        $this->add($factory->nombre());
        $this->add($factory->email());
        $this->add($factory->password());
        $this->add($factory->confirmar());
        $this->add($factory->csrf($this->security->getSessionToken()));
    }

    public function mensajes($name){
        if($this->hasMessagesFor($name)){
            foreach($this->getMessagesFor($name) as $message){
                return $message;
            }
        }
    }
}

