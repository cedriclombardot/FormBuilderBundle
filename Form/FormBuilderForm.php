<?php

namespace Lombardot\FormBuilderBundle\Form;

use Symfony\Component\Form\HiddenField;

use Symfony\Component\Form\TextareaField;

use Symfony\Component\Form\Form;

use Symfony\Component\Form\TextField;

class FormBuilderForm extends Form
{

	public function configure()
	{
		$this->add(
			new HiddenField('id')
		);
		
		$this->add(
			new TextField('form_name')
		);
		
		$this->add(
			new TextareaField('description')
		);
		
	}
	
	
}