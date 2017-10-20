<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher){
        // Si hay un mensaje guardado en la sesion lo recupera y muestra
        if($this->flashSession->has()){
            $arr_mensajes=$this->flashSession->getMessages();
            foreach($arr_mensajes as $tipo => $mensajes){
                foreach($mensajes as $mensaje){
                    $this->flash->message($tipo,$mensaje);
                }
            }
        }
    }

    public function initialize()
    {
        $this->view->setVar('is_auth',false);
//        $this->partial
        $this->view->menu=[
/*            'Reportes'=>['hijos'=>[
                ['Resumen'  ,'reportes/resumen'     ],
                ['Ganadores','reportes/ganadores'   ],
            ]],
*/            'Registro'=>['uri'=>'sesion/registro'],
        ];
    }
}
