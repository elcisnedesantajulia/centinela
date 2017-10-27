<?php namespace Centinela;

use Phalcon\Mvc\User\Component;
use Centinela\Models\Usuarios;

//Maneja la autenticacion/identidad 
class Auth extends Component
{
    public function getIdentidad()
    {
        return $this->session->get('identidad');
    }

    public function check($credentials)
    {
        $usuario = Usuarios::findFirstByEmail($credentials['email']);
        if($usuario == false){
            throw new Exception('Email/Password incorrectos');
        }
        if(!($this->security->checkHash(
            $credentials['password'],
            $usuario->password
        ))){
            throw new Exception('Email/Password incorrectos');
        }
        $this->checkUserFlags($usuario);
        $this->session->set('identidad',[
            'id'    =>$usuario->id,
            'nombre'=>$usuario->nombre,
            'perfil'=>$usuario->perfil->nombre,
        ]);
    }

    public function checkUserFlags(Usuarios $usuario){
        if($usuario->bloqueado == 1){
            throw new Exception('El usuario esta bloqueado');
        }
    }

    public function getNombre(){
        $identidad = $this->session->get('identidad');
        return $identidad['nombre'];
    }

    public function remove()
    {
        $this->session->remove('identidad');
    }
/*
    public function getUsuario(){
        $identidad=$this->session->get('identidad');
        if(isset($identidad['id'])){
            $usuario = Usuarios::findFirstById($identidad'id']);
            if($usuario==false){
                throw new Exception('El usuario no existe');
            }
            return $usuario;
        }
        return false;
    }
*/
}

