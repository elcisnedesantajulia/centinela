<?php namespace Centinela\Controllers;

use Centinela\Models\Usuarios;
use Centinela\Forms\RegistroForm;
use Centinela\Forms\LoginForm;
use Centinela\Exception;
use Centinela\TagsFactory as Tags;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->view->index = $this->index;
    }

    public function indexAction(){

    }

    public function registroAction(){
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
                    $this->redirectIndex('Tu cuenta ha sido creada, ya puedes '.
                        'ingresar al sitio');
                }   
                $this->flash->error($usuario->getMessages());
            }
        }
        $this->view->form = $form;
//        $this->view->tags = new Tags;
        $this->view->menu=[];
        $this->view->setVar('is_registro',true);
    }

    public function loginAction()
    {
        $form = new LoginForm();
        try{
            if($this->request->isPost()){
                if($form->isValid($this->request->getPost()) == false){
                    $mensajes = $form->getMessages();
                    $this->flash->error($mensajes[0]);
                }else{
                    $this->auth->check([
                        'email'     =>$this->request->getPost('email'),
                        'password'  =>$this->request->getPost('password'),
                    ]);
                    return $this->response->redirect('index');
                }
            }
        } catch (Exception $e){
            $this->flash->error($e->getMessage());
        }
    }

    public function logoutAction(){
        $this->auth->remove();
        return $this->response->redirect('index');
    }
}

