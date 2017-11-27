<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Controladores extends Model
{
    public $id;
    public $mtime;
    public $ctime;
    public $controlador;

    public function initialize()
    {
        $this->hasMany('id',__NAMESPACE__.'\Acciones','controladorId',[
            'alias'     =>'acciones',
            'params'    =>[
                'order' => 'accion ASC',
            ],
            'foreignKey'=>['No puede ser borrado porque está siendo usado en Acciones'],
        ]);

        $this->addBehavior(new Timestampable([
            'beforeCreate'=>[
                'field'=>'ctime',
                'format'=>'Y-m-d H:i:s',
            ],
            'beforeUpdate'=>[
                'field'=>'mtime',
                'format'=>'Y-m-d H:i:s',
            ],
        ]));
    }

    public function validation(){
        $validator = new Validation();
        // Valida que los emails sean unicos por usuario
        $validator->add('controlador',new Uniqueness([
            'message' => 'El nombre debe ser único, ya existe un controlador '.
                'con ese nombre',
        ]));
        return $this->validate($validator);
    }

    public function getCaption()
    {
        return ucfirst($this->controlador);
    }
}

