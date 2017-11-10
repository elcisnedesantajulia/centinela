<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

class Perfiles extends Model
{
    public $id;
    public $mtime;
    public $ctime;
    public $nombre;
    public $caption;
    public $activo;

    public function initialize()    {
        $this->hasMany('id',__NAMESPACE__.'\Usuarios','perfilId',[
            'alias'=>'usuarios',
            'foreignKey'=>[
                'message'=>'No puede ser borrado porque esta siendo usado en Usuarios',
            ],
        ]);
        $this->hasMany('id',__NAMESPACE__.'\Permisos','perfilId',[
            'alias'=>'permisos',
            'foreignKey'=>[
                'message'=>'No puede ser borrado porque esta siendo usado en Permisos',
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

    public function validation(){
        $validator = new Validation();
        // Valida que los emails sean unicos por usuario
        $validator->add('nombre',new Uniqueness([
            'message' => 'El nombre del perfil ya fue registrado',
        ]));
        // Valida que los nombres no esten vacios despues de aplicar el trim
        $validator->add('caption',new PresenceOf([
            'message' => 'El caption no puede estar vacío',
        ]));
        return $this->validate($validator);
    }

}

