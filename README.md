# FormBuilderBundle

FormBuilderBundle is my first Symfony2 Plugin, and it's a concept portage of
spyFormBuilder2Plugin to ease make a form generator for CMS.

This Bundle will be completly rewrited using Symfony2 Bundles and some other 
standards.

# How to Install

## 1) Routing

Add this route :

	_adminformbuilder:
	    resource: "@LombardotFormBuilderBundle/Controller"
	    type:     annotation
	    prefix:   /form-builder

## 2) In your AppKernel add

	$bundles[] = new Lombardot\FormBuilderBundle\FormBuilderBundle();

## 3) In autoload register :

	'Lombardot'						 => __DIR__.'/../src',

## 4)  Configure doctrine entity generation

In config.yml :

	# Doctrine Configuration
	doctrine:
	 
	    orm:
	        entity_managers:
	            default:
	                mappings:
	                    LombardotFormBuilderBundle: ~

And run :
	php app/console doctrine:generate:entities LombardotFormBuilderBundle
	php app/console php app/console doctrine:schema:update --force 
		                    
## 5) Routing
	                                        
_adminformbuilder:
    resource: "@LombardotFormBuilderBundle/Controller"
    type:     annotation
    prefix:   /form-builder

# TODO

This is the start of project today so specification and documentation
