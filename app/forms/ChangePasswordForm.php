<?php namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class ChangePasswordForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        $factory = new Factory();

        $this->add($factory->password());
        $this->add($factory->confirmar());

        if( isset($options['old']) && $options['old'] )
        {
            $this->add($factory->oldPassword());
            $this->get('password')->setAttributes([
                'placeholder'=>'Nuevo password',
            ]);
            $this->get('confirmar')->setAttributes([
                'placeholder'=>'Confirmar nuevo password',
            ]);
        }
    }
}

