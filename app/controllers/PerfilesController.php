<?php namespace Centinela\Controllers;

use Centinela\Models\Perfiles;
use Centinela\PaginatorModel as Paginator;

class PerfilesController extends ControllerBase
{
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
            'page'      =>$page,
            'adjacents' =>5,
        ]);
        $this->view->paginator = $paginator->getPaginate();
    }

    public function createAction()
    {

    }
}

