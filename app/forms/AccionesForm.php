<?php namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class AccionesForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        $inline = (isset($options['inline']) && $options['inline']==true ) ? 
            true : false;
        $empty = (isset($options['empty']) && $options['empty']==true ) ?
            true : false;
        $factory = new Factory();
        $this->add($factory->accion());
        $this->add($factory->controladores($inline,$empty));
        $this->add($factory->caption());
        $this->add(
            $inline ? $factory->selectPublica() : $factory->publica()
        );
    }
}


