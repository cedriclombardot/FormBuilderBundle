<?php

namespace Lombardot\FormBuilderBundle\Admin;

use WhiteOctober\AdminBundle\DataManager\Doctrine\ORM\Admin\DoctrineORMAdmin;


class FormBuilderAdmin extends DoctrineORMAdmin
{
	 protected function configure()
    {

    	$this
        ->setDataClass('Lombardot\FormBuilderBundle\Entity\FormBuilder')
        ->addActions(array(
            'doctrine.orm.crud',
        ))
        ->addFields(array(
            'form_name',
        	'description'
            // ...
        ))
    ;
    	
    }
	
}