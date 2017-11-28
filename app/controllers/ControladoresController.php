<?php namespace Centinela\Controllers;

use Centinela\Forms\ControladoresForm;
use Centinela\Models\Controladores;
use Centinela\PaginatorModel as Paginator;

class ControladoresController extends ControllerBase
{
    public function initialize()
    {
        $this->index='controladores/index';
        $this->view->index = $this->index;
    }

    public function indexAction()
    {
        $params = ['order'     =>'prioridad ASC'];
        $controladores = Controladores::find($params);
        if(count($controladores) == 0){
            $this->flash->notice('No hay resultados');
            return;
        }
        $paginator = new Paginator([
            'data'      =>$controladores,
            'limit'     =>20,
            'page'      =>1,
            'adjacents' =>5,
        ]);
        $this->view->paginator = $paginator->getPaginate();
    }

    public function createAction()
    {
        $form = new ControladoresForm;

        if($this->request->isPost()){
            if($form->isValid($this->request->getPost())){
                $controlador = new Controladores([
                    'controlador'=>$this->request->getPost('controlador',
                        ['trim','striptags','lower']),
                ]);
                if(!$controlador->save()){
                    $this->flash->notice($controlador->getMessages());
                }else{
                    $this->redirectIndex('El controlador ha sido creado!');
                }
            }
        }

        $this->view->form = $form;
    }

    public function editAction($id)
    {
        $controlador = $this->findControladorByIdOrRedirect($id);
        $form = new ControladoresForm($controlador);

        if($this->request->isPost()){
            $controlador->assign([
                'controlador'=>$this->request->getPost('controlador',
                        ['trim','striptags','lower']),
            ]);
            $form = new ControladoresForm($controlador);
            if($form->isValid($this->request->getPost())){
                if(!$controlador->save()){
                    $this->redirectIndex(implode("\n",$controlador->getMessages()),
                        'error');
                }
                $this->redirectIndex('Se guardaron los cambios');
            }
        }

        $this->view->controlador = $controlador;
        $this->view->form = $form;
    }

    public function deleteAction($id)
    {
        $controlador = $this->findControladorByIdOrRedirect($id);
        if(!$controlador->delete()){
            $this->redirectIndex(implode("\n",$controlador->getMessages()),'error');
        }
        $this->redirectIndex('El controlador fue borrado');
    }

    private function findControladorByIdOrRedirect($id)
    {
        $controlador = Controladores::findFirstById($id);
        if(!$controlador){
            $this->redirectIndex('No se encontró el controlador','error');
        }

        return $controlador;
    }
}

