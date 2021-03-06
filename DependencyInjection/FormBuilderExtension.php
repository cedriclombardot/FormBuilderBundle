<?php

namespace Lombardot\FormBuilderBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use Symfony\Component\DependencyInjection\ContainerBuilder;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;



/**
 * Semantic FormBuilder configuration.
 *
 * @author Cedric LOMBARDOT
 */
class FormBuilderExtension extends Extension
{
	/**
     * Loads the configuration.
     *
     * @param array            $configs   An array of configuration settings
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function load(array $configs, ContainerBuilder $container)
    {
    }
    
    /**
     * @see Extension::getAlias()
     */
	public function getAlias()
    {
        return 'form_builder';
    }
}