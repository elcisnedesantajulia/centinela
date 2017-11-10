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

    public function btnDelete($href,$title)
    {
        return $this->btnIcon($href,'trash','danger',$title);
    }

    public function btnDeleteUser($id,$name)
    {
        return <<<html
<span data-toggle="tooltip" data-placement="top" title='Borrar usuario'>
<button type="button" class="btn btn-outline-danger" data-toggle="modal" 
      data-target="#deleteUserModal" data-userid="$id" data-username="$name" >    
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
            'data-placement'=>'top'
        ]);
    }

    public function btnCreateUser()
    {
        return $this->btnIconText('usuarios/create','person','success'
            ,'Crear nuevo usuario');
    }

    public function btnCreatePerfil()
    {
        return $this->btnIconText('perfiles/create','people','success'
            ,'Crear nuevo perfil');
    }

    public function btnRegresar($href)
    {
        return $this->btnIconText($href,'action-undo','danger','Regresar');
    }

    public function btnIconText($href,$icon,$color,$text)
    {
        return Tag::linkTo([
            $href,
            // Open iconic https://useiconic.com/ope
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
}

