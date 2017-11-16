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
        
    }
}

