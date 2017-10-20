<?php namespace Centinela\Controllers;

use Centinela\Models\Usuarios;
use Centinela\Forms\RegistroForm;

class SesionController extends ControllerBase
{
    public function indexAction(){

    }

    public function registroAction(){
/*
        if(is_array($this->auth->getIdentity()))
        {
            return $this->dispatcher->forward([
                'controller'=>'index',
                'action'=>'index',
            ]);
        }
*/
        $form = new RegistroForm();
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost()) != false){
                $usuario = new Usuarios([
                    'nombre'=>$this->request->getPost('nombre','striptags'),
                    'email' =>$this->request->getPost('email'),
                    'password'=>$this->security->hash($this->request->getPost('password')),
                    'perfilId'=>4,
                ]);
                if($usuario->save())
                {
                    $this->flashSession->success('Tu cuenta ha sido creada, ya '.
                        'puedes ingresar al sitio');     
                    return $this->response->redirect('index/index');
                }   
                $this->flash->error($usuario->getMessages());
            }
        }
        $this->view->form = $form;
        $this->view->setVar('is_registro',true);
    }

}

