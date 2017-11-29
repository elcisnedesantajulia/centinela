<?php namespace Centinela;

use Phalcon\Tag;

class TagsFactory
{
    public function btnEdit($href,$title)
    {
        return $this->btnIcon($href,'pencil','primary',$title);
    }

    public function btnPassword($href,$title)
    {
        return $this->btnIcon($href,'key','warning',$title);
    }

    public function btnPrivilegios($perfilId)
    {
        return $this->btnIcon('perfiles/privilegios/'.$perfilId,'key','info',
            'Editar privilegios');
    }

    public function btnDeleteUser($id,$name)
    {
        return $this->btnModalDelete($id,$name,'Borrar usuario','#deleteUserModal');
        return <<<html
</span>
html;
    }

    public function btnDeleteControlador($id,$name)
    {
        return $this->btnModalDelete($id,$name,'Borrar controlador',
            '#deleteControladorModal');
    }

    public function btnDeleteAccion($id,$name)
    {   
        return $this->btnModalDelete($id,$name,'Borrar acción',
            '#deleteAccionModal');
    }

    public function btnModalDelete($id,$name,$title,$target)
    {
        return <<<html
<span data-toggle="tooltip" data-placement="top" title="$title">
<button type="button" class="btn btn-outline-danger" data-toggle="modal" 
      data-target="$target" data-id="$id" data-name="$name" >
  <span class="oi oi-trash"></span>
</button>
</span>
html;
    }

    public function btnIcon($href,$icon,$color,$title)
    {
        return Tag::linkTo([
            $href,
            // Open iconic https://useiconic.com/open
            '<span class="oi oi-'.$icon.'"></span>',
            // Bootstrap 4 https://getbootstrap.com/docs/4.0/utilities/colors/
            'class'         =>'btn btn-outline-'.$color,
            'role'          =>'button',
            'title'         =>$title,
            'data-toggle'   =>'tooltip',
            'data-placement'=>'top',
        ]);
    }

    public function btnCreateUser()
    {
        return $this->btnIconText('usuarios/create','person','success',
            'Crear nuevo usuario');
    }

    public function btnCreatePerfil()
    {
        return $this->btnIconText('perfiles/create','people','success',
            'Crear nuevo perfil');
    }

    public function btnCreateControlador()
    {
        return $this->btnIconText('controladores/create','folder','success',
            'Crear nuevo controlador');
    }

    public function btnCreateAccion()
    {
        return $this->btnIconText('acciones/create','puzzle-piece','success',
            'Crear nueva acción');
    }

    public function btnRegresar($href)
    {
        return $this->btnIconText($href,'action-undo','danger','Regresar');
    }

    public function btnIconText($href,$icon,$color,$text)
    {
        return Tag::linkTo([
            $href,
            // Open iconic https://useiconic.com/open
            '<span class="oi oi-'.$icon.'"></span> '.$text,
            // Bootstrap 4 https://getbootstrap.com/docs/4.0/utilities/colors/
            'class' =>'btn btn-outline-'.$color,
            'role'  =>'button',
        ]);
    }

    public function submitSuccess($caption)
    {
        $submit = Tag::submitButton([
            $caption,
            'class' => 'btn btn-outline-success btn-block',
        ]);

        return <<<html
<div class="form-group">
$submit
</div>
html;
    }

    public function checkPrivilegio($id,$label,$checked=false,$tabla='acciones')
    {
        $name = $tabla.'[]';
        $renderChecked = $checked ? 'checked="checked"' : '';
        return <<<html
<div class="form-check">
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="$name" value="$id" 
        $renderChecked />
    $label
  </label>
</div>
html;
    }

    public function boolIcon($estado=1)
    {
        if($estado){
            $color = 'success';
            $icono = 'check';
        }else{
            $color = 'danger';
            $icono = 'x';
        }
        return <<<html
<span class="oi oi-$icono text-$color"></span>
html;
    }

    public function boolLock($estado=1)
    {
        if($estado){
            $color = 'success';
            $icono = 'lock-locked';
        }else{
            $color = 'danger';
            $icono = 'lock-unlocked';
        }
        return <<<html
<span class="oi oi-$icono text-$color"></span>
html;
    }
}

