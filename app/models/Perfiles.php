<?php namespace Centinela\Models;

use Phalcon\Mvc\Model;

class Perfiles extends Model
{
    public $id;
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
    }
}

