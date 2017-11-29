<?php namespace Centinela\Controllers;

use Centinela\Forms\PerfilesForm;
use Centinela\Models\Controladores;
use Centinela\Models\Perfiles;
use Centinela\Models\PrivilegiosAcciones;
use Centinela\PaginatorModel as Paginator;

class PerfilesController extends ControllerBase
{
    public function initialize()
    {
        $this->index='perfiles/index';
        $this->view->index = $this->index;
    }

    public function indexAction()
    {
        $params = [];
        $perfiles = Perfiles::find($params);
        if(count($perfiles) == 0){
            $this->flash->notice('No hay resultados');
            return;
        }
        $paginator = new Paginator([
            'data'      =>$perfiles,
            'limit'     =>20,
            'page'      =>1,
            'adjacents' =>5,
        ]);
        $this->view->paginator = $paginator->getPaginate();
    }

    public function createAction()
    {
        $form = new PerfilesForm();

        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $perfil = new Perfiles([
                    'nombre'    =>$this->request->getPost('nombre',
                        ['trim','striptags','lower']),
                    'caption'   =>$this->request->getPost('caption',
                        ['trim','striptags']),
                    'activo'    =>1,
                ]);
                if(!$perfil->save()){
                    $this->flash->notice($perfil->getMessages());
                }else{
                    $this->acl->rebuild();
                    $this->redirectIndex('El perfil ha sido creado!');
                }
            }
        }

        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $perfil = $this->findPerfilByIdOrRedirect($id);
        $permanente = $perfil->permanente;
        $form = new PerfilesForm($perfil);
        if($this->request->isPost()){
            $perfil->assign([
                'nombre'    => $permanente ? $perfil->nombre :
                    $this->request->getPost('nombre',['trim','striptags','lower']),
                'caption'   =>$this->request->getPost('caption',
                    ['trim','striptags']),
                'activo'    => $permanente ? $perfil->activo :
                    ($this->request->getPost('activo'))? 1 : 0 ,
            ]);
            $form = new PerfilesForm($perfil);
            if($form->isValid($this->request->getPost())){
                if(!$perfil->save()){
                    $this->redirectIndex(implode("\n",$perfil->getMessages()),'error');
                }
                $this->acl->rebuild();
                $this->redirectIndex('Se guardaron los cambios');
            }
        }

        $this->view->perfil = $perfil;
        $this->view->form = $form;
    }

    public function privilegiosAction($id)
    {
        $perfil = $this->findPerfilByIdOrRedirect($id);
        if(!$perfil->activo){
            $this->redirectIndex('El perfil no está activo','error');
        }

        if($this->request->isPost() && $this->request->hasPost('acciones')){
            $perfil->getPrivilegiosAcciones()->delete();
            foreach($this->request->getPost('acciones') as $accionId){
                $privilegio = new PrivilegiosAcciones();
                $privilegio->perfilId = $id;
                $privilegio->accionId = $accionId;
                $privilegio->save();
            }
            $this->acl->rebuild();
            $this->flash->success('Se actualizaron los permisos');
        }

        $this->view->controladores = Controladores::find([
            'order'     =>'prioridad ASC',
        ]);

        foreach($perfil->privilegiosAcciones as $privilegio){
            $privilegiosAcciones[$privilegio->accionId]=true;
        }
        $this->view->privilegiosAcciones=$privilegiosAcciones;

        $this->view->perfil = $perfil;
    }

    private function findPerfilByIdOrRedirect($id)
    {
        $perfil = Perfiles::findFirstById($id);
        if(!$perfil){
            $this->redirectIndex('No se encontró el perfil','error');
        }

        return $perfil;
    }
}

