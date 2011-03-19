<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Lombardot\FormBuilderBundle\Form\FormBuilderForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Finder;

use Lombardot\FormBuilderBundle\Services\JSON\FormDescription;

use Symfony\Component\Finder\SplFileInfo;

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
    	$filePath = $this->container->getParameter('form_builder.data_dir').$this->get('request')->get('id').'.json';
    	
    	if(!file_exists($filePath)) {
    		throw new \Exception(sprintf('The file %s does not exist',$filePath));
    	}

    	$SplFileInfo = new SplFileInfo($filePath,$this->get('request')->get('id').'.json',$this->get('request')->get('id').'.json');
    	
        $FormDescription = new FormDescription($this->container);
    	$file = $FormDescription->readJson($SplFileInfo);
    	
    	$form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	$form->setData($file);
    	
    	if($this->container->get('request')->get($form->getName())) {
    		$form->bind($this->container->get('request'));
    		if($form->isValid()) {
    			$form->save();
    			return new \Symfony\Component\HttpFoundation\RedirectResponse($this->container->get('router')->generate('_adminformbuilder_edit',array('id'=> $FormDescription->getId())));
    		}
    	}    	
    	
    	return array('file' => $file, 'form' => $form);
    }
}