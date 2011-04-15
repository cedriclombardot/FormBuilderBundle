<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Lombardot\FormBuilderBundle\Form\FormBuilderForm;

use Lombardot\FormBuilderBundle\Form\FormBuilder;

use Lombardot\FormBuilderBundle\Form\FormBuilderFieldForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{

 	/**
     * @extra:Route("/admin", name="_adminformbuilder")
     * @extra:Template
     */
    public function indexAction()
    {
    	
    	$FormBuilderForms = $this->container->get('doctrine.orm.entity_manager')
    				->createQueryBuilder()
    				->select('f')
    				->from('Lombardot\FormBuilderBundle\Entity\FormBuilder','f')
    				->getQuery()
    				->getResult();
    	
        return array('FormBuilderForms' => $FormBuilderForms, 'count' => sizeof($FormBuilderForms));
    }
    
    /**
     * @extra:Route("/admin/new", name="_adminformbuilder_new")
     * @extra:Template
     */
    public function newAction()
    {
    	$form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	$formbuilder = new FormBuilder();
		$form->bind($this->get('request'),$formbuilder);
    	
    	return array('form' => $form);
    }
    
 	/**
     * @extra:Route("/admin/{id}/edit", name="_adminformbuilder_edit")
     * @extra:Template
     */
    public function editAction($id)
    {
        $form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	$formbuilder = $this->get('doctrine.orm.entity_manager')
    					->find('Lombardot\FormBuilderBundle\Entity\FormBuilder',$id);
		
    	$form->bind($this->get('request'),$formbuilder);
    	
    	return array('FormBuilderForm' => $formbuilder, 'form' => $form);
    }
    
    /**
     * @extra:Route("/admin/update", name="_adminformbuilder_update")
     */
    public function updateAction()
    {
    	$form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	
    	list($formbuilder,$FormBuilderEntity) = $this->findOrCreate($form);
    	
    	$form->bind($this->get('request'),$formbuilder);
    	
    	if($form->isValid()) {
    		$FormBuilderEntity = $formbuilder->save($this->container,$FormBuilderEntity);
    		return new RedirectResponse(
    							$this->generateUrl('_adminformbuilder_edit',
    								array('id'=> $formbuilder->getId())
    							)
    					);
    	}
    	
    	/*if($formbuilder->getId()!='')
    	{
    		//@todo forward edit
    	}
    	else 
    	{
    		//@todo forward new
    	}*/
    }
    
    /**
     * Find or create method
     *  @return \Lombardot\FormBuilderBundle\Form\FormBuilder if new
     *  @return \Lombardot\FormBuilderBundle\Entity\FormBuilder if not new
     */
    private function findOrCreate(FormBuilderForm $form)
    {
    	$req = $this->container->get('request')->get($form->getName());
    	if($req['id']!='')
    	{
	    	$entity = $this->get('doctrine.orm.entity_manager')
	    					->find('Lombardot\FormBuilderBundle\Entity\FormBuilder',$req['id']);
	    	$form = new FormBuilder();
	    	$form->fromEntity($entity);
	    	return array($form,$entity);
    	}
    	
    	return array(new FormBuilder(),null);
    }
    
    /**
     * Action to add a field in a specific form
     * @extra:Route("/admin/{id}/add_field", name="_adminformbuilder_add_field")
     * @extra:Template
     */
    public function addFieldAction()
    {
    	$FormDescription = FormDescription::getForm($this->get('request')->get('id'), $this->container);
    	$form = FormBuilderFieldForm::create($this->get('form.context'), 'formbuilder_field');
    	$file = $FormDescription->readJson();
    	
    	$field = $FormDescription->createANewField();
    	$form->setData($field);
    	
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
     * Action to edit a field in a specific form
     * @extra:Route("/admin/{id}/edit_field/{field}", name="_adminformbuilder_edit_field")
     * @extra:Template
     */
    public function editFieldAction()
    {
    	
    }
}