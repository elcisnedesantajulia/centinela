<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    protected $index = 'index/index';

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
                'Privilegios'=>[
                    'Perfiles'      =>'perfiles/index',
                    'Usuarios'      =>'usuarios/index',
                    'Controladores' =>'controladores/index',
                    'Acciones'      =>'acciones/index',
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

    protected function redirectIndex($message,$alertType='success')
    {
        $this->flashSession->$alertType($message);
        $this->response->redirect($this->index);
        $this->response->send();
        exit;
    }
}
