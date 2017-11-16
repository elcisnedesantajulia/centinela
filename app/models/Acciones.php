<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Acciones extends Model
{
    public $id;
    public $mtime;
    public $ctime;
    public $accion;
    public $controladorId;

    public function initialize()
    {
        $this->belongsTo('controladorId',__NAMESPACE__.'\Controladores','id',[
            'alias'     =>'controlador',
            'reusable'  =>true, // cacheado implícitamente
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
            'message' => 'El nombre del controlador ya fue registrado',
        ]));
        return $this->validate($validator);
    }
}

