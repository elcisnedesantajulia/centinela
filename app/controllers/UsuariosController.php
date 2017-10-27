<?php
namespace Centinela\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Centinela\Forms\UsuariosForm;
use Centinela\Forms\ChangePasswordForm;
use Centinela\Models\Usuarios;
use Centinela\PaginatorModel as Paginator;
use Centinela\TagsFactory as Tags;

class UsuariosController extends ControllerBase
{
    public function indexAction(){
//        $this->view->url_create=$this->url->get('usuarios/create');
        $this->view->form = new UsuariosForm();
        // Si no existe $_GET['page'] la pagina es 1
        $page = $this->request->getQuery('page', 'int', 1);
        // TODO revisar si es post y formar un Criteria
        $params = [];
        // TODO buscar si hay params en la sesion
        $usuarios = Usuarios::find($params);
        if(count($usuarios) == 0){
            $this->flash->notice('No hay resultados');
            return;
        }
        $paginator = new Paginator([
            'data'      =>$usuarios,
            'limit'     =>20,
            'page'      =>$page,
            'adjacents' =>5,
        ]);
        $this->view->paginator = $paginator->getPaginate();
        $this->view->tags = new Tags;
    }

    public function createAction(){
        $form = new UsuariosForm(null);
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())==false){
                foreach($form->getMessages() as $message){
                    $this->flash->error($message);
                }
            }else{
                $id_perfil=$this->request->getPost('id_perfil','int');
                $usuario = new AclUsuarios([
                    'nombre'    =>$this->request->getPost('nombre','striptags'),
                    'email'     =>$this->request->getPost('email','email'),
                    'password'  =>$this->security->hash($this->request->getPost('password')),
                    'id_perfil' =>$id_perfil==0?1:$id_perfil,
                ]);
                if(!$usuario->save()){
                    $this->flash->error($usuario->getMessages());
                }
                else{
                    $this->flash->success('El usuario ha sido creado!');
                    return $this->dispatcher->forward([
                        'controller'=>'usuarios',
                        'action'=>'index'
                    ]);
                }
            }
        }
        $this->view->url_back=$this->url->get('usuarios/search');
        $this->view->form = $form;
    }

    public function editAction($id){
        $usuario = Usuarios::findFirstById($id);
        if(!$usuario){
            $this->flash->error('No se encontro el usuario');
            return $this->dispatcher->forward([
                'action'=>'index'
            ]);
        }
        if($this->request->isPost()){
            $usuario->assign([
                'nombre'    =>$this->request->getPost('nombre','striptags'),
                'id_perfil' =>$this->request->getPost('id_perfil','int'),
                'email'     =>$this->request->getPost('email','email'),
                'bloqueado' =>$this->request->getPost('bloqueado'),
            ]);
            $form = new UsuariosForm($usuario,[
                'edit'=>true
            ]);
            if($form->isValid($this->request->getPost())==false){
                foreach($form->getMessages() as $message){
                    $this->flash->error($message);
                }
            }else{
                if(!$usuario->save()){
                    $this->flash->error($usuario->getMessages());
                }else{
                    $this->flash->success('Se guardaron los cambios');
                    return $this->dispatcher->forward([
                        'action'=>'search'
                    ]);                
                }
            }
        }
        $this->view->url_back=$this->url->get('usuarios/search');
        $this->view->usuario = $usuario;
        $this->view->form = new UsuariosForm($usuario,[
            'edit'=>'true'
        ]);
    }

    public function deleteAction($id_usuario){
        $usuario = AclUsuarios::findFirstByIdUsuario($id_usuario);
        if(!$usuario){
            $this->flash->error('No se encontro el usuario');
            return $this->dispatcher->forward([
                'action'=>'search'
            ]);
        }
        if(!$usuario->delete()){
            $this->flash->error($usuario->getMessages());
        }else{
            $this->flash->success('El usuario fue borrado');
        }
        return $this->dispatcher->forward([
            'action'=>'search'
        ]);
    }

    public function changePasswordAction($id){
        $identity=$this->auth->getIdentity();
        $id=$identity['perfil']=='Administradores'?$id:$identity['id'];
        $usuario = Usuarios::findFirstById($id);
        if(!$usuario){
            $this->flash->error('No se encontro el usuario');
            return $this->dispatcher->forward([
                'controller'=>'index',
                'action'=>'index'
            ]);
        }
        $form = new ChangePasswordForm();
        if($this->request->isPost()){
            if(!$form->isValid($this->request->getPost())){
                foreach($form->getMessages() as $message){
                    $this->flash->error($message);
                }
            }else{
                $usuario->password=$this->security->hash($this->request->getPost('password'));
                if(!$usuario->save()){
                    $this->flash->error($user-getMessages());
                }else{
                    $this->flash->success('El password ha sido cambiado');
//                    Tag::resetInput();
                }
            }
        }
        $this->view->usuario = $usuario;
        $this->view->form = $form;
    }
}

