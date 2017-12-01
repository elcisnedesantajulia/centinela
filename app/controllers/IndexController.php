<?php namespace Centinela\Controllers;

use Centinela\Models\Usuarios;
use Centinela\Forms\RegistroForm;
use Centinela\Forms\LoginForm;
use Centinela\Forms\ChangePasswordForm;
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
        $this->view->menu=[];
        $this->view->is_registro = true;
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

    public function logoutAction()
    {
        $this->auth->remove();
        return $this->response->redirect('index');
    }

    public function passwordAction()
    {
        $usuario = $this->auth->getUsuario();
        if(!$usuario){
            $this->redirectIndex('No se encontró el usuario','error');
        }
        $form = new ChangePasswordForm(null,['old'=>true]);

        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $old = $this->request->getPost('old');
                if($this->security->checkHash($old,$usuario->password)){
                    $usuario->password=$this->security->hash(
                        $this->request->getPost('password')
                    );
                    if($usuario->save()){
                        $this->redirectIndex('El password ha sido cambiado');
                    }
                    $this->flash->error($usuario->getMessages());
                }else{
                    $this->flash->error('El password actual no es válido');
                }
            }
        }

        $this->view->usuario = $usuario;
        $this->view->form = $form;
    }

    public function cuentaAction()
    {
        $this->view->usuario = $this->auth->getUsuario();
    }

    public function instalacionAction()
    {

    }
}

