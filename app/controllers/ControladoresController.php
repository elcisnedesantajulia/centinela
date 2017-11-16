<?php namespace Centinela\Controllers;

use Centinela\Forms\ControladoresForm;
use Centinela\Models\Controladores;
use Centinela\PaginatorModel as Paginator;

class ControladoresController extends ControllerBase
{
    public function indexAction()
    {
        $params = [];
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

        $this->view->back = 'controladores/index';
        $this->view->form = $form;
    }

    private function redirectIndex($message,$alertType='success')
    {
        // TODO pasar a ControllersBase y guardar en una propiedad 'controladores/index'
        $this->flashSession->$alertType($message);
        $this->response->redirect('controladores/index');
        $this->response->send();
        exit;
    }
}

