<?php namespace Centinela;

use Phalcon\Mvc\User\Component;
use Phalcon\Acl\Adapter\Memory as AclMemory;
use Phalcon\Acl\Role as AclRole;
use Phalcon\Acl\Resource as AclResource;
use Rosh\Models\Perfiles;
use Rosh\Models\Acciones;

class Acl extends Component
{
    private $acl;
    private $filePath;
    
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
            $acl->addResource(new AclResource($accion->getPath()),'use')
        }

        // Autoriza acceso a los usuarios de acuerdo a su perfil (role)
        foreach($perfiles as $perfil)
        {
            foreach($perfil->getPermisos() as $permiso)
            {
                $acl->allow($perfil->nombre,$permiso->recurso,$permiso->accion);
            }
            // Siempre da permiso de cambiar password a usuarios autenticados
            $acl->allow($perfil->nombre,'usuarios','changePassword');
        }
        $filePath = $this->getFilePath();
        if(touch($filePath)  && is_writable($filePath))
        {
            file_put_contents($filePath,serialize($acl));
            if(function_exists('apc_store'))
            {
                apc_store('rosh-acl',$acl);
            }
        }
        else
        {
            $this->flash->error(
                'No hay permisos de escritura para guardar la ACL en '.$filePath
            );
        }
        return $acl;
    }

    protected function getFilePath()
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

    public function addPrivateResources(array $resources)
    {
        if(count($resources)>0)
        {
            $this->privateResources = array_merge($this->privateResources,$resources);
            if(is_object($this->acl))
            {
                $this->acl = $this->rebuild();
            }
        }
    }

    public function isAllowed($profile,$controller,$action)
    {
        return $this->getAcl()->isAllowed($profile,$controller,$action);
    }

    public function getAcl()
    {
        // Checa si el Acl ya fue creado
        if(is_object($this->acl))
        {
            return $this->acl;
        }
        //Si no, checa si el ACL esta en el cache
        if(function_exists('apc_fetch'))
        {
            $acl=apc_fetch('rosh-acl');
            if(is_object($acl))
            {
                $this->acl=$acl;
                return $acl;
            }
        }
        $filePath=$this->getFilePath();
        // Si no, y aparte no hay archivo guardado, lo reconstruye a partir de DB
        if(!file_exists($filePath))
        {
            $this->acl = $this->rebuild();
            return $this->acl;
        }
        // Finalmente, si lo demas falla, lo obtiene del archivo y lo guarda en cache
        $data=file_get_contents($filePath);
        $this->acl = unserialize($data);
        if(function_exists('apc_store'))
        {
            apc_store('rosh-acl',$this->acl);
        }
        return $this->acl;
    }

    protected function getFilePath()
    {
        if(!isset($this->filePath))
        {
            $this->filePath = rtrim($this->config->application->cacheDir,'\\/').'/acl/data.txt';
        }
        return $this->filePath;
    }
*/
}
