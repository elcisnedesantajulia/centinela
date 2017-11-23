<?php namespace Centinela\Forms;

use Centinela\FormElementsFactory as Factory;
use Centinela\Bootstrap4Form as Form;

class PerfilesForm extends Form
{
    public function initialize($entity=null,$options=null)
    {
        $factory = new Factory();
        // Si el perfil es permanente se deshabilita el nombre y activo
        $permanente=($entity != null && $entity->permanente)? true : false;

        $this->add($factory->caption());

        if($permanente){
            $this->add($factory->hidden('nombre'));
            $this->add($factory->hidden('activo'));
        }else{
            $this->add($factory->perfilesNombre());
            $this->add($factory->activo());
        }
    }
}

