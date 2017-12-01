<?php namespace Centinela\Controllers;

use Phalcon\Mvc\Model\Criteria;
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
        $form = new AccionesForm(null,[
            'inline'=>true,
            'empty'=>true,
        ]);
        $page = 1;
        if($this->request->isPost()){
            $query=Criteria::fromInput($this->di,'Centinela\Models\Acciones',$this->request->getPost());
            $query->orderBy('controladorId,publica DESC,id');
            $this->persistent->accionesCondiciones=$query->getParams();
        }else{
            // Si no existe $_GET['page'] la pagina es 1
            $page = $this->request->getQuery('page', 'int', 1);
        }
        $condiciones = [
            'order' => 'controladorId,publica DESC,id'
        ];
        if($this->persistent->accionesCondiciones){
            $condiciones = $this->persistent->accionesCondiciones;
            if(isset($condiciones['bind'])){
                $form->bind($condiciones['bind'],new Acciones());
            }
        }
        $this->view->form = $form;
        $acciones = Acciones::find($condiciones);
        if(count($acciones) == 0){ return; }
        $paginator = new Paginator([
            'data'      =>$acciones,
            'limit'     =>10,
            'page'      =>$page,
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
                    'caption'       =>$this->request->getPost('caption',
                        ['trim','striptags']),
                    'publica'       =>$this->request->getPost('publica')? 1 : 0 ,
                ]);
                if(!$accion->save()){
                    $this->flash->notice($accion->getMessages());
                }else{
                    $this->acl->rebuild();
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
                'caption'       =>$this->request->getPost('caption',
                    ['trim','striptags']),
                'publica'       =>$this->request->getPost('publica')? 1 : 0 ,
            ]);
            $form = new AccionesForm($accion);
            if($form->isValid($this->request->getPost())){
                if(!$accion->save()){
                    $this->redirectIndex(implode("\n",$accion->getMessages()),
                        'error');
                }
                $this->acl->rebuild();
                $this->redirectIndex('Se guardaron los cambios');
            }
        }

        $this->view->accion = $accion;
        $this->view->form = $form;
    }

    public function deleteAction($id)
    {
        $accion = $this->findAccionByIdOrRedirect($id);
        if(!$accion->delete()){
            $this->redirectIndex(implode("\n",$accion->getMessages()),'error');
        }
        $this->acl->rebuild();
        $this->redirectIndex('La acción fue borrada');
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

