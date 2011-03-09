<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Lombardot\FormBuilderBundle\Form\FormBuilderForm;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Finder;

use Lombardot\FormBuilderBundle\Services\JSON\FormDescriptionReader;

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
    		$FormDescriptionReader = new FormDescriptionReader();
    	    $files[]=$FormDescriptionReader->readJson($file);
    	}
        return array('files' => $files, 'count_files' => sizeof($files));
    }
    
    
 	/**
     * @extra:Route("/edit/{id}", name="_adminformbuilder_edit")
     * @extra:Template()
     */
    public function editAction()
    {
    	$filePath = $this->container->getParameter('form_builder.data_dir').$this->get('request')->get('id').'.json';
    	
    	if(!file_exists($filePath)) {
    		throw new \Exception(sprintf('The file %s does not exist',$filePath));
    	}

    	$SplFileInfo = new SplFileInfo($filePath,$this->get('request')->get('id').'.json',$this->get('request')->get('id').'.json');
    	
        $FormDescriptionReader = new FormDescriptionReader();
    	$file = $FormDescriptionReader->readJson($SplFileInfo);
    	
    	$form = FormBuilderForm::create($this->get('form.context'), 'formbuilder');
    	$form->setData($file);
    	
    	return array('file' => $file, 'form' => $form);
    }
}