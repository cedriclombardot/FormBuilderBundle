<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminFieldController extends Controller
{
	
	/**
     * @extra:Route("/admin/{form_id}/list-fields", name="_adminformbuilder_addfield")
     * @extra:Template
     */
    public function indexAction()
    {
		return array();
    }
    
}