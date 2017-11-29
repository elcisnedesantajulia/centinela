<?php namespace Centinela;

use Phalcon\Mvc\User\Component;
use Phalcon\Acl\Adapter\Memory as AclMemory;
use Phalcon\Acl\Role as AclRole;
use Phalcon\Acl\Resource as AclResource;
use Centinela\Models\Perfiles;
use Centinela\Models\Acciones;

class Acl extends Component
{
    private $acl;
    private $filePath;

    public function getAcl()
    {
        // Checa si el Acl ya fue creado
        if(is_object($this->acl))
        {
            return $this->acl;
        }
        // Si no, y hay archivo guardado, lo obtiene del archivo
        $filePath=$this->getFilePath();
        if(file_exists($filePath))
        {
            $data=file_get_contents($filePath);
            $this->acl = unserialize($data);
            return $this->acl;
        }
        // Si lo demás falla, lo reconstruye a partir de DB
        return $this->rebuild();
    }

    public function isAllowed($rol,$recurso,$acceso)
    {
        return $this->getAcl()->isAllowed($rol,$recurso,$acceso);
    }

    public function rebuild()
    {
        $acl = new AclMemory();
        $acl->setDefaultAction(\Phalcon\Acl::DENY);

        // Registra los roles
        $perfiles = Perfiles::find([
            'activo = :activo:',
            'bind' =>[
                'activo'=>1
            ],
        ]);
        foreach($perfiles as $perfil)
        {
            $acl->addRole(new AclRole($perfil->nombre));
        }
        // Registra los recursos
        $acciones = Acciones::find();
        foreach($acciones as $accion)
        {
            $acl->addResource(new AclResource($accion->getPath()),'use');
            //Da permiso a todos los perfiles de usar acciones públicas
            if($accion->publica == 1){
                foreach($perfiles as $perfil){
                    $acl->allow($perfil->nombre,$accion->getPath(),'use');
                }
            }
        }

        // Autoriza acceso a los usuarios de acuerdo a su perfil (role)
        foreach($perfiles as $perfil)
        {
            foreach($perfil->getPrivilegiosAcciones() as $privilegio){
                $acl->allow(
                    $perfil->nombre,
                    $privilegio->accion->getPath(),
                    'use'
                );
            }
        }
        $filePath = $this->getFilePath();
        if(touch($filePath) && is_writable($filePath))
        {
            file_put_contents($filePath,serialize($acl));
        }
        else
        {
            $this->flash->error(
                'No hay permisos de escritura para guardar la ACL en '.$filePath
            );
        }
        $this->acl = $acl;
        return $acl;
    }

    private function getFilePath()
    {
        if(!isset($this->filePath))
        {
            $this->filePath = rtrim($this->config->application->cacheDir,'\\/').
                '/acl/data.txt';
        }
        return $this->filePath;
    }

//--------------
/*
    public function isPrivate($controllerName)
    {
        $controllerName=strtolower($controllerName);
        return isset($this->privateResources[$controllerName]);
    }
*/
}
