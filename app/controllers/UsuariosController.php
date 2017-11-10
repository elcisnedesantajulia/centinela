<?php
namespace Centinela\Controllers;

//use Phalcon\Mvc\Model\Criteria;
use Centinela\Forms\UsuariosForm;
use Centinela\Forms\ChangePasswordForm;
use Centinela\Models\Usuarios;
use Centinela\PaginatorModel as Paginator;

class UsuariosController extends ControllerBase
{
    public function indexAction(){
        $this->view->form = new UsuariosForm();
        // Si no existe $_GET['page'] la pagina es 1
        $page = $this->request->getQuery('page', 'int', 1);
        // TODO revisar si es post y formar un Criteria
        $params = ["borrado = 0"];
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
    }

    public function createAction()
    {
        $form = new UsuariosForm();
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $usuario = new Usuarios([
                    'nombre'    =>$this->request->getPost('nombre',
                        ['trim','striptags']),
                    'email'     =>$this->request->getPost('email','email'),
                    'password'  =>$this->security->hash(
                        $this->request->getPost('password')),
                    'perfilId'  =>$this->request->getPost('perfilId','int'),
                    'bloqueado' =>0,
                ]);
                if(!$usuario->save()){
                    $this->flash->notice($usuario->getMessages());
                }
                else{
                    $this->redirectIndex('El usuario ha sido creado!');
                }
            }
        }
        $this->view->back = 'usuarios/index';
        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $usuario = $this->findUserByIdOrRedirect($id);
        $form = new UsuariosForm($usuario,[
            'edit'=>true
        ]);
        if($this->request->isPost()){
            $usuario->assign([
                'nombre'    =>$this->request->getPost('nombre',
                    ['trim','striptags']),
                'email'     =>$this->request->getPost('email',['email','lower']),
                'perfilId'  =>$this->request->getPost('perfilId','int'),
                'bloqueado' =>($this->request->getPost('bloqueado'))? 1 : 0 ,
            ]);
            $form = new UsuariosForm($usuario,[
                'edit'=>true
            ]);
            if($form->isValid($this->request->getPost())){
                if(!$usuario->save()){
                    $this->redirectIndex(implode("\n",$usuario->getMessages()),'error');
                }
                $this->redirectIndex('Se guardaron los cambios');
            }
        }
        $this->view->usuario = $usuario;
        $this->view->back = 'usuarios/index';
        $this->view->form = $form;
    }

    public function deleteAction($id)
    {
        $usuario = $this->findUserByIdOrRedirect($id);
        if(!$usuario->delete()){
            $this->redirectIndex(implode("\n",$usuario->getMessages()),'error');
        }
        $this->redirectIndex('El usuario fue borrado');
    }

    public function passwordAction($id)
    {
        $usuario = $this->findUserByIdOrRedirect($id);
        $form = new ChangePasswordForm();
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $usuario->password=$this->security->hash($this->request->getPost('password'));
                if(!$usuario->save()){
                    $this->flash->error($usuario->getMessages());
                }else{
                    $this->redirectIndex('El password ha sido cambiado');
                }
            }
        }
        $this->view->usuario = $usuario;
        $this->view->back = 'usuarios/index';
        $this->view->form = $form;
    }

    private function findUserByIdOrRedirect($id)
    {
        $usuario = Usuarios::findFirstById($id);
        if(!$usuario){
            $this->redirectIndex('No se encontró el usuario','error');
        }

        return $usuario;
    }

    private function redirectIndex($message,$alertType='success')
    {
        $this->flashSession->$alertType($message);
        $this->response->redirect('usuarios/index');
        $this->response->send();
        exit;
    }
}

