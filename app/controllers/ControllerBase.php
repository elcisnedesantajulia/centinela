<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    protected $index = 'index/index';
    protected $identidad ;

    public function beforeExecuteRoute(Dispatcher $dispatcher){
        $this->displayRedirectMessages();
        $this->view->setVar('debug','fuera');
        $this->view->setVar('is_auth',false);
        $this->view->menu=[
            'Registro'=>'index/registro',
        ];
        
        $this->identidad = $this->auth->getIdentidad();
        if( $this->identidad['perfil'] != 'visita' ){
            $this->view->setVar('is_auth',true);
            $this->view->setVar('debug','dentro');
            $this->view->menu=[
                'Administración'=>[
                    'Perfiles'      =>'perfiles/index',
                    'Usuarios'      =>'usuarios/index',
                    'Controladores' =>'controladores/index',
                    'Acciones'      =>'acciones/index',
                ],
            ];
        }
        $controlador = $dispatcher->getControllerName();
        $accion = $dispatcher->getActionName();

        $recurso=$controlador.'/'.$accion;
        if (!$this->acl->isAllowed($this->identidad['perfil'],$recurso,'use')){
            if( $this->identidad['perfil'] != 'visita' ){
                $this->flash->error('Error inesperado, notifícalo al administrador');
            }
            $dispatcher->forward([
                'controller' => 'error',
                'action' => 'show404'
            ]);
        }
//print_r($controlador.'/'.$accion); exit;
    }

    private function displayRedirectMessages()
    {
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
