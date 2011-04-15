<?php 

namespace Lombardot\FormBuilderBundle\Entity;

/**
 * @orm:Entity
 * @orm:Table(name="formbuilder_form")
 */
class FormBuilder
{
	/**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue
     */
    private $id = null;

    /**
     * @orm:Column(type="string", length="255")
     */
    private $form_name = null;

    /**
     * @orm:Column(type="string", length="1000")
     */
    private $description = null;
	

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set form_name
     *
     * @param string $formName
     */
    public function setFormName($formName)
    {
        $this->form_name = $formName;
    }

    /**
     * Get form_name
     *
     * @return string $formName
     */
    public function getFormName()
    {
        return $this->form_name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }
}