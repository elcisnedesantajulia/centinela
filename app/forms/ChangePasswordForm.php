<?php
namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class ChangePasswordForm extends Form
{
    public function initialize(){

        // Factory instancia elementos reusables en varios formularios
        $factory = new Factory();

            $this->add($factory->password());
            $this->add($factory->confirmar());

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

