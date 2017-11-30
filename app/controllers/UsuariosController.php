<?php
namespace Centinela\Controllers;

//use Phalcon\Mvc\Model\Criteria;
use Centinela\Forms\UsuariosForm;
use Centinela\Forms\ChangePasswordForm;
use Centinela\Models\Usuarios;
use Centinela\PaginatorModel as Paginator;

class UsuariosController extends ControllerBase
{
    public function initialize()
    {
        $this->index='usuarios/index';
        $this->view->index = $this->index;
    }

    public function indexAction(){
        $this->view->form = new UsuariosForm();
        // Si no existe $_GET['page'] la pagina es 1
        $page = $this->request->getQuery('page', 'int', 1);
        // TODO revisar si es post y formar un Criteria
        $condiciones[] = "borrado = 0";
        // Unicamente los usuarios super pueden ver usuarios de su tipo
//        $identidad = $this->auth->getIdentidad();
        if( $this->identidad['perfil'] != 'super' ){
            $condiciones[0].=" AND perfilId != '1'";
        }
        // TODO buscar si hay params en la sesion
        $usuarios = Usuarios::find($condiciones);
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
                $perfilId = $this->request->getPost('perfilId','int');
                // Solo un usuario de tipo super puede crear otro super
                if( $this->identidad['perfil'] != 'super' && $perfilId==1){
                    $this->redirectIndex('Error de permisos','error');
                }
                $usuario = new Usuarios([
                    'nombre'    =>$this->request->getPost('nombre',
                        ['trim','striptags']),
                    'email'     =>$this->request->getPost('email','email'),
                    'password'  =>$this->security->hash(
                        $this->request->getPost('password')),
                    'perfilId'  =>$perfilId,
                    'bloqueado' =>0,
                ]);
                if($usuario->save()){
                    $this->redirectIndex('El usuario ha sido creado!');
                }
                $this->flash->notice($usuario->getMessages());
            }
        }
        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $usuario = $this->findUserByIdOrRedirect($id);
        $form = new UsuariosForm($usuario,[
            'edit'=>true
        ]);
        if($this->request->isPost()){
            $perfilId = $this->request->getPost('perfilId','int');
            // Solo un usuario de tipo super puede crear otro super
            if( $this->identidad['perfil'] != 'super' && $perfilId==1){
                $this->redirectIndex('Error de permisos','error');
            }
            $usuario->assign([
                'nombre'    =>$this->request->getPost('nombre',
                    ['trim','striptags']),
                'email'     =>$this->request->getPost('email',['email','lower']),
                'perfilId'  =>$perfilId,
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
                $usuario->password=$this->security->hash(
                    $this->request->getPost('password')
                );
                if($usuario->save()){
                    $this->redirectIndex('El password ha sido cambiado');
                }
                $this->flash->error($usuario->getMessages());
            }
        }
        $this->view->usuario = $usuario;
        $this->view->form = $form;
    }

    private function findUserByIdOrRedirect($id)
    {
        $usuario = Usuarios::findFirstById($id);
        if(!$usuario){
            $this->redirectIndex('No se encontró el usuario','error');
        }
        // Unicamente los usuarios super pueden ver usuarios de su tipo
        if($this->identidad['perfil'] != 'super' && $usuario->perfilId==1){
            $this->redirectIndex('Error de permisos','error');
        }

        return $usuario;
    }
}

