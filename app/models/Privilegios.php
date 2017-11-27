<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Privilegios extends Model
{
    public $id;
    public $mtime;
    public $ctime;
    public $perfilId;
    public $tiposId;
    public $recursosId;

    public function initialize()
    {
        $this->belongsTo('perfilId',__NAMESPACE__.'\Perfiles','id',[
            'alias'     =>'perfil',
            'reusable'  =>true, // cacheado implicitamente
        ]);
        $this->belongsTo('tiposId',__NAMESPACE__.'\PrivilegiosTipos','id',[
            'alias'     =>'tipo',
            'reusable'  =>true, // cacheado implicitamente
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
        $validator->add(['perfilId','tiposId','controladorId'],new Uniqueness([
            'message' => 'Este privilegio ya fue registrado previamente',
        ]));
        // TODO add Validation InclusionIn para validar que perfilId, tiposId y 
        //      recursosId existan 
        return $this->validate($validator);
    }
}

