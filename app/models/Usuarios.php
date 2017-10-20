<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class Usuarios extends Model
{
    const BORRADO    = 1;
    const NO_BORRADO = 0;

    public $id;
    public $ctime;
    public $nombre;
    public $email;
    public $password;
    public $perfilId;
    public $bloqueado;
    public $borrado;

    public function initialize(){
        $this->belongsTo('perfilId',__NAMESPACE__.'\Perfiles','id',[
            'alias'     =>'perfil',
            'reusable'  =>true, // cacheado implicitamente
        ]);
        $this->skipAttributesOnUpdate([
            'password',
        ]);
        $this->addBehavior(new SoftDelete([
            'field'=>'borrado',
            'value'=>Usuarios::BORRADO,
        ]));
        $this->addBehavior(new Timestampable([
            'beforeCreate'=>[
                'field'=>'ctime',
                'format'=>'Y-m-d H:i:s',
            ],
        ]));
    }

    // Valida que los emails sean unicos por usuario
    public function Validation(){
        $validator = new Validation();
        $validator->add('email',new Uniqueness([
            'message' => 'El email ya fue registrado',
        ]));
        return $this->validate($validator);
    }
}

