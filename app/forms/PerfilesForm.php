<?php namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class PerfilesForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        $factory = new Factory();
        $this->add($factory->perfilesNombre());
        $this->add($factory->caption());
        $this->add($factory->activo());
    }
}

