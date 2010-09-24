<?php

class Form_Dico extends Zend_Form
{
    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->setName('dico');

        $id = new Zend_Form_Element_Hidden('id');

		$file = new Zend_Form_Element_File('url');
		$file->setLabel('Choisir un dictionnaire:')
              ->setValueDisabled(true);        

        $type = new Zend_Form_Element_Radio('type', array(
		    'multiOptions' => array(
		        "conjugaisons" => 'conjugaisons'
		        ,"adjectifs" => 'adjectifs'
		        ,"substantif" => 'substantif'
		        ,"syntagme" => 'syntagme'
		        ,"déterminants" => 'déterminants')
		));
        $type->setLabel('Définir un type');

        $envoyer = new Zend_Form_Element_Submit('envoyer');
        $envoyer->setAttrib('id', 'boutonenvoyer');
		$this->setAttrib('enctype', 'multipart/form-data');
        $this->addElements(array($id, $file, $type, $envoyer));
    }
}
