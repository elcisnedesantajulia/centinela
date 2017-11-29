<?php namespace Centinela;

use Phalcon\Mvc\User\Component;
use Centinela\Models\Usuarios;

//Maneja la autenticacion/identidad 
class Auth extends Component
{
    public function getIdentidad()
    {
        if(!$this->session->get('identidad')){
            $this->configVisita();
        }
        return $this->session->get('identidad');
    }

    /**
     * Checa si las credenciales son válidas y guarda en sesion una variable 
     * de identidad
     * @param array $credentials[email=>,password=>]
     */
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
        $identidad = [
            'id'    =>$usuario->id,
            'nombre'=>$usuario->nombre,
            'perfil'=>$usuario->perfil->nombre,
        ];
        // Si el perfil del usuario no está activo, se considera como 'registrado'
        if($usuario->perfil->activo == 0){
            $identidad['perfil'] = 'registrado';
        }
        $this->session->set('identidad',$identidad);
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
        $this->configVisita();
    }

    private function configVisita()
    {
        $this->session->set('identidad',[
            'id'    =>0,
            'nombre'=>'Anónimo',
            'perfil'=>'visita',
        ]);
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

