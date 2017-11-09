<?php namespace Centinela;

use Phalcon\Tag;
use Phalcon\Forms\Form;

class Bootstrap4Form extends Form
{
    // @override
    public function render($name,$attributes=null){
        $element=$this->get($name);
        $decorator = $element->getUserOption('decorator',false);
        if($decorator && method_exists($this,$decorator)){
            return $this->$decorator($name);
        }
        return parent::render($name,$attributes);
    }

    public function afterValidation(){
        foreach($this as $element){
            if($this->hasMessagesFor($element->getName())){
                $element->setUserOption('valid','invalid');
            }else{
                $element->setUserOption('valid','valid');
            }
        }
    }

    public function renderText($name){
        $element=$this->get($name);
        $htmlClasses=['form-control'];
        //Mensaje por defecto - client side
        $invalidMessage='Falta introducir este campo';
        if($this->hasMessagesFor($name)){
            $mensajes = $this->getMessagesFor($name);
            // Mensaje - server side
            $invalidMessage=$mensajes[0]->getMessage();
        }else{
            $invalidMessage = $element->getUserOption('clientSide',false)
                ? $element->getUserOption('clientSide') : $invalidMessage;
        }
        $valid=$element->getUserOption('valid',false);
        if($valid == 'valid'){
            $invalidMessage = '';
            $htmlClasses[]='is-valid';
        }elseif($valid == 'invalid'){
            $htmlClasses[]='is-invalid';
        }

        $element->setAttribute('class',implode(' ',$htmlClasses));
        $render = $element->render();
        return <<<html
<div class="form-group">
  $render
  <div class="invalid-feedback">$invalidMessage</div>
</div>
html;
    }

    public function renderSelectAsRadio($name){
        $element=$this->get($name);

        $opts = $element->getOptions();
        $value = $element->getValue();
        $html_opts='';
        foreach ($opts as $op_label) {
            $id = $op_label->id;
            $checked = ($id == $value) ? 'checked' : '' ;
            $active = ($id == $value) ? 'active' : '' ;
            $caption = $op_label->caption;
            $html_opts.=<<<html
<label class="btn btn-outline-info $active">
    <input type="radio" name="$name" value="$id" $checked id="$id" autocomplete="off"/>
        $caption<br/>
</label>
html;
        }
        return <<<html
<div class="btn-group" data-toggle="buttons">
  $html_opts
</div>
html;
    }

    public function renderSelect($name){
        $element=$this->get($name);
        $element->setAttribute('class','form-control');
        $render = $element->render();
        return <<<html
<div class="form-group">
  $render
</div>
html;
    }

    public function renderCheck($name){
        $element=$this->get($name);
        $element->setAttribute('class','form-check-input');
        $render = $element->render();
        $label = $element->getLabel();
return <<<html
<div class="form-check">
  <label class="form-check-label">
    $render
    $label
  </label>
</div>
html;
    }
}

