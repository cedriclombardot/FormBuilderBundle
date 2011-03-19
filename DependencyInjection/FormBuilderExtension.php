<?php

namespace Lombardot\FormBuilderBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

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
    	$loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('form_builder.xml');
    }
    
	/**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return __DIR__.'/../Resources/config/schema';
    }
	
    /**
     * @see Extension::getNamespace()
     */
    public function getNamespace()
    {
        return 'http://symfony.com/schema/dic/symfony_extra';
    }
    
    /**
     * @see Extension::getAlias()
     */
	public function getAlias()
    {
        return 'form_builder';
    }
}