<?php namespace Centinela\Controllers;

use Centinela\Forms\AccionesForm;
use Centinela\Models\Acciones;
use Centinela\PaginatorModel as Paginator;

class AccionesController extends ControllerBase
{
    public function initialize()
    {
        $this->index='acciones/index';
        $this->view->index = $this->index;
    }

    public function indexAction()
    {
        $params = [];
        $acciones = Acciones::find($params);
        if(count($acciones) == 0){
            $this->flash->notice('No hay resultados');
            return;
        }
        $paginator = new Paginator([
            'data'      =>$acciones,
            'limit'     =>20,
            'page'      =>1,
            'adjacents' =>5,
        ]);
        $this->view->paginator = $paginator->getPaginate();
    }

    public function createAction()
    {
        $form = new AccionesForm;
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $accion = new Acciones([
                    'accion'        =>$this->request->getPost('accion',
                        ['trim','striptags']),
                    'controladorId' =>$this->request->getPost('controladorId','int'),
                ]);
                if(!$accion->save()){
                    $this->flash->notice($accion->getMessages());
                }else{
                    $this->redirectIndex('La acción ha sido creada!');
                }
            }
        }

        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $accion = $this->findAccionByIdOrRedirect($id);
        $form = new AccionesForm($accion);

        if($this->request->isPost()){
            $accion->assign([
                'accion'        =>$this->request->getPost('accion',
                    ['trim','striptags']),
                'controladorId' =>$this->request->getPost('controladorId','int'),
            ]);
            $form = new AccionesForm($accion);
            if($form->isValid($this->request->getPost())){
                if(!$accion->save()){
                    $this->redirectIndex(implode("\n",$accion->getMessages()),
                        'error');
                }
                $this->redirectIndex('Se guardaron los cambios');
            }
        }

        $this->view->accion = $accion;
        $this->view->form = $form;
    }

    private function findAccionByIdOrRedirect($id)
    {
        $accion = Acciones::findFirstById($id);
        if(!$accion){
            $this->redirectIndex('No se encontró la acción','error');
        }

        return $accion;
    }
}

