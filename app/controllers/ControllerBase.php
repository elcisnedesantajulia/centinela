<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher){
        $this->displayRedirectMessages();
        $this->view->setVar('debug','fuera');
        $this->view->setVar('is_auth',false);
        $this->view->menu=[
/*            'Reportes'=>['hijos'=>[
                ['Resumen'  ,'reportes/resumen'     ],
                ['Ganadores','reportes/ganadores'   ],
            ]],
*/            'Registro'=>'sesion/registro',
        ];
        $identidad = $this->auth->getIdentidad();
        if(is_array($identidad)){
            $this->view->setVar('is_auth',true);
            $this->view->setVar('debug','dentro');
            $this->view->menu=[
                'Accesos'=>[
                    'Perfiles'=>'perfiles/index',
                    'Usuarios'=>'usuarios/index',
                ],
            ];
        }

//var_dump($identidad); exit;
    }

    private function displayRedirectMessages(){
        // Si hay mensajes guardados en la sesion los recupera y muestra
        if($this->flashSession->has()){
            $arr_mensajes=$this->flashSession->getMessages();
            foreach($arr_mensajes as $tipo => $mensajes){
                foreach($mensajes as $mensaje){
                    $this->flash->message($tipo,$mensaje);
                }
            }
        }
    }
}
