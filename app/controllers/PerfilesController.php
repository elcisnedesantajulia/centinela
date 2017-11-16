<?php namespace Centinela\Controllers;

use Centinela\Forms\PerfilesForm;
use Centinela\Models\Perfiles;
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
                    $this->redirectIndex('El perfil ha sido creado!');
                }
            }
        }

        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $perfil = $this->findPerfilByIdOrRedirect($id);
        $form = new PerfilesForm($perfil);
        if($this->request->isPost()){
            $perfil->assign([
                'nombre'    =>$this->request->getPost('nombre',
                    ['trim','striptags','lower']),
                'caption'   =>$this->request->getPost('caption',
                    ['trim','striptags']),
                'activo'    =>($this->request->getPost('activo'))? 1 : 0 ,
            ]);
            $form = new PerfilesForm($perfil);
            if($form->isValid($this->request->getPost())){
                if(!$perfil->save()){
                    $this->redirectIndex(implode("\n",$perfil->getMessages()),'error');
                }
                $this->redirectIndex('Se guardaron los cambios');
            }
        }

        $this->view->perfil = $perfil;
        $this->view->form = $form;
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

