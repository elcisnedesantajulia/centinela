<?php namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class AccionesForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        $factory = new Factory();
        $this->add($factory->accion());
        $this->add($factory->controladores());
        $this->add($factory->caption());
    }
}


