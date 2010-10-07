<?php
class Form_Concept extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('concept');

        $id = new Zend_Form_Element_Hidden('id');
        $id->setValue($options["id"]);
      	        		
      	$lib = new Zend_Form_Element_Text('lib');
      	$lib->setRequired(true);
		$lib->setLabel('Définir un libellé');
        
		$type = new Zend_Form_Element_Select('type', array(
		    'multiOptions' => array("v"=>"verbe","a"=>"adjectif","m"=>"substantif","s"=>"syntagme")));
      	$type->setRequired(true);
		$type->setLabel("Choisir un type");
		
        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');
		$this->setAttrib('enctype', 'multipart/form-data');
        $this->addElements(array($id, $lib, $type, $envoyer));
    }
}
