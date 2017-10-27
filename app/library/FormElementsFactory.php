<?php namespace Centinela;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Centinela\Models\Perfiles;

class FormElementsFactory
{
//    private $htmlClass;
/*
    public function __construct($is_inline = false){
        $htmlClass='form-control';
        $htmlClass .= $is_inline==true ? ' mb-2 mr-sm-2 mb-sm-0' : '';
        $this->htmlClass = $htmlClass;
    }
*/
    public function nombre(){
        return $this->textRequired('nombre','Nombre','El nombre es requerido');
    }

    public function email(){
        return $this->emailValido('email','Email','Introduce un email válido');
    }

    public function perfiles()
    {
        // TODO implementar reglas segun los privilegios de usuario
        $perfiles = Perfiles::find([
            'activo = :activo:',
            'bind' => ['activo' => 1]
        ]);
        $selectPerfiles =  new Select('perfilId',$perfiles,[
            'using' => ['id','caption'],
        ]);
        $selectPerfiles->setUserOption('decorator','renderSelectAsRadio');

        return $selectPerfiles;
    }

    public function textRequired($name,$caption,$message){
        $element = new Text($name);
        $element->setUserOption('decorator','renderText');
        $this->configRequired($element,$caption,$message);

        return $element;
    }

    public function emailValido($name,$caption,$message)
    {
        $element = new Email($name);
        $element->setUserOption('decorator','renderText');
        $this->configEmail($element,$caption,$message);

        return $element;
    }

    private function configRequired($element,$caption,$message){
        $this->configDefault($element,$caption,$message);
        $element->addValidator(new PresenceOf([
            'message'=>$message
        ]));
    }

    private function configEmail($element,$caption,$message){
        $this->configDefault($element,$caption,$message);
        $element->addValidator(new EmailValidator([
            'message'=>$message
        ]));
    }

    private function configDefault($element,$caption,$message){
        $element->setAttributes([
            'placeholder'=>$caption,
//            'class'=>$this->htmlClass,
            'required'=>true,
        ]);
        $element->setUserOption('clientSide',$message);
    }
}
