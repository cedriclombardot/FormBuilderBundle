<?php 
/**
 * Form validation object to help to create a new
 * Lombardot\FormBuilderBundle\Entity\FormBuilder
 * 
 * @author cedric LOMBARDOT
 */

namespace Lombardot\FormBuilderBundle\Form;


use Symfony\Component\DependencyInjection\ContainerInterface;

class FormBuilder
{
	/**
     * @assert:Interger
     */
    private $id = null;
    
    /**
     * @assert:NotBlank
     */
    private $form_name = null;

    /**
     * @assert:NotBlank
     */
    private $description = null;
    
    /**
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	

    /**
     * 
     * @return string
     */
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * 
     * @param $form_name
     */
    public function setFormName($form_name)
    {
        $this->form_name = $form_name;
    }

    /**
     * 
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * 
     * @param $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    
    public function fromEntity(\Lombardot\FormBuilderBundle\Entity\FormBuilder $Entity)
    {
    	$this->setId($Entity->getId());
    	$this->setFormName($Entity->getFormName());
    	$this->setDescription($Entity->getDescription());
    }
    
	public function toEntity(\Lombardot\FormBuilderBundle\Entity\FormBuilder $FormBuilder=null)
    {
    	if(is_null($FormBuilder)){
    		$FormBuilder = new \Lombardot\FormBuilderBundle\Entity\FormBuilder();
    	}
    	
    	$FormBuilder->setFormName($this->getFormName());
    	$FormBuilder->setDescription($this->getDescription());
    	return $FormBuilder;
    }
    
    public function save(ContainerInterface $container, \Lombardot\FormBuilderBundle\Entity\FormBuilder $FormBuilder=null)
    {
    	$FormBuilder = $this->toEntity($FormBuilder);
    	
    	$entityManager = $container->get('doctrine.orm.entity_manager');
    	$entityManager->persist($FormBuilder);
		$entityManager->flush();
		
		return $FormBuilder;
    }	
}