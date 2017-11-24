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
    public $caption;

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
        $validator->add(['accion','controladorId'],new Uniqueness([
            'message' => 'El nombre de la accion ya fue registrado en ese controlador',
        ]));
        // TODO add Validation InclusionIn para validar que el controladorId sí
        //      exista 
        return $this->validate($validator);
    }

    public function getPath()
    {
        return $this->controlador->controlador.'/'.$this->accion;
    }

}

