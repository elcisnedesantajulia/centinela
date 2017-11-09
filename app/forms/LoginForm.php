<?php
namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class LoginForm extends Form
{
    public function initialize($entity=null,$options=null){

        // Factory instancia elementos reusables en varios formularios
        $factory = new Factory();
        $this->add($factory->email());
        $this->add($factory->password());
        $this->add($factory->csrf($this->security->getSessionToken()));
    }
}

