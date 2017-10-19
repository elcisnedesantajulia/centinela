<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->view->setVar('is_auth',false);
//        $this->partial
        $this->view->menu=[
            'Reportes'=>['hijos'=>[
                ['Resumen'  ,'reportes/resumen'     ],
                ['Ganadores','reportes/ganadores'   ],
            ]],
            'Usuarios'=>['uri'=>'usuarios'],
        ];
    }
}
