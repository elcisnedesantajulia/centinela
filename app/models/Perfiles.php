<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;

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
}

