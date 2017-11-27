<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class PrivilegiosTipos extends Model
{
    public $id;
    public $mtime;
    public $ctime;
    public $tabla;

    public function initialize()
    {
        $this->hasMany('id',__NAMESPACE__'\Privilegios','tiposId',[
            'alias'     =>'privilegios',
            'foreignKey'=>[
                'message'=>'No puede ser borrado porque está siendo usado en Privilegios',
            ],
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

    public function validation()
    {
        $validator = new Validation();
        // Valida que los emails sean unicos por usuario
        $validator->add('table',new Uniqueness([
            'message' => 'El nombre de la tabla ya fue registrado',
        ]));
        return $this->validate($validator);
    }
}

