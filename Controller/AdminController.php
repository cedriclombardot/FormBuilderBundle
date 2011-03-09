<?php

namespace Lombardot\FormBuilderBundle\Controller;

use Doctrine\ORM\Configuration;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Finder\Finder;

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
    	    $files[]=$file->getFilename();
    	}
        return array('files' => $files, 'count_files' => sizeof($files));
    }
    
}