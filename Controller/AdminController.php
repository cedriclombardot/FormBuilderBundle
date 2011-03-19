<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Lombardot\FormBuilderBundle\Form\FormBuilderForm;
use Lombardot\FormBuilderBundle\Form\FormBuilderFieldForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Finder;

use Lombardot\FormBuilderBundle\Services\JSON\FormDescription;

use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{

 	/**
     * @extra:Route("/admin", name="_adminformbuilder")
     * @extra:Template()
     */
    public function indexAction()
    {
    	$files = array();
    	$finder = new Finder();
    	$finder->files()
    		   ->ignoreVCS(true)
    	       ->name('*.json')
    	       ->in($this->container->getParameter('form_builder.data_dir'));

    	foreach ($finder as $file) {
    		$FormDescription = new FormDescription();
    	    $files[]=$FormDescription->readJson($file);
    	}
        return array('files' => $files, 'count_files' => sizeof($files));
    }
    
    
 	/**
     * @extra:Route("/admin/edit/{id}", name="_adminformbuilder_edit")
     * @extra:Template()
     */
    public function editAction()
    {
        $FormDescription = FormDescription::getForm($this->get('request')->get('id'), $this->container);
    	$file = $FormDescription->readJson();
    	
    	$form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	$form->setData($file);
    	
    	if($this->container->get('request')->get($form->getName())) {
    		$form->bind($this->container->get('request'));
    		if($form->isValid()) {
    			$form->save();
    			return new RedirectResponse($this->container
    						->get('router')
    						->generate('_adminformbuilder_edit',
    									array('id'=> $FormDescription->getId())
    								)
    						);
    		}
    	}    	
    	
    	return array('file' => $file, 'form' => $form);
    }
    
    /**
     * Action to add a fiel in a specific form
     * @extra:Route("/admin/{id}/add_field", name="_adminformbuilder_add_field")
     * @extra:Template()
     */
    public function addFieldAction()
    {
    	$FormDescription = FormDescription::getForm($this->get('request')->get('id'), $this->container);
    	$form = FormBuilderFieldForm::create($this->get('form.context'), 'formbuilder_field');
    	$file = $FormDescription->readJson();
    	
    	if($this->container->get('request')->get($form->getName())) {
    		$form->bind($this->container->get('request'));
    		if($form->isValid()) {
    			$form->save();
    			return new RedirectResponse($this->container
    						->get('router')
    						->generate('_adminformbuilder_edit',
    									array('id'=> $FormDescription->getId())
    								)
    						);
    		}
    	}
    	return array('file' => $file, 'form' => $form);
    }
    
    
    
}