<?php namespace Centinela\Controllers;

use Centinela\Forms\RegistroForm;

class SesionController extends ControllerBase
{
    public function indexAction(){

    }

    public function registroAction(){
/*
        if(is_array($this->auth->getIdentity()))
        {
            return $this->dispatcher->forward([
                'controller'=>'index',
                'action'=>'index',
            ]);
        }
*/
        $form = new RegistroForm();
        if($this->request->isPost()){
            if($form->isValid($this->request->getPost()) != false){
                $this->flash->error("Validado");
            }
        }

        $this->view->form = $form;
    }

}

