<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

class Usuarios extends Model
{
    const BORRADO    = 1;
    const NO_BORRADO = 0;

    public $id;
    public $mtime;
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
        $this->addBehavior(new SoftDelete([
            'field'=>'borrado',
            'value'=>Usuarios::BORRADO,
        ]));
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
        $validator->add('email',new Uniqueness([
            'message' => 'El email ya fue registrado',
        ]));
        // Valida que los nombres no esten vacios despues de aplicar el trim
        $validator->add('nombre',new PresenceOf([
            'message' => 'El nombre no puede estar vacío',
        ]));
        return $this->validate($validator);
    }
}

