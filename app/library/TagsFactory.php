<?php namespace Centinela;

use Phalcon\Tag;

class TagsFactory
{
    public function btnEdit($href,$title){
        return $this->btnIcon($href,'pencil','primary',$title);
    }

    public function btnPassword($href,$title){
        return $this->btnIcon($href,'key','warning',$title);
    }

    public function btnDelete($href,$title){
        return $this->btnIcon($href,'trash','danger',$title);
    }

    public function btnIcon($href,$icon,$color,$title){
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
}

