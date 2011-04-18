<?php 

namespace Lombardot\FormBuilderBundle\Entity;

/**
 * @orm:Entity
 * @orm:Table(name="formbuilder_field")
 */
class FormBuilderField
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
    private $name = null;

    /**
     * @orm:Column(type="string", length="1000")
     */
    private $label = null;
	
    /**
     * @orm:ManyToOne(targetEntity="FormBuilderType")
     */
    private $type = null;


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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * Get label
     *
     * @return string $label
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set type
     *
     * @param Lombardot\FormBuilderBundle\Entity\FormBuilderType $type
     */
    public function setType(\Lombardot\FormBuilderBundle\Entity\FormBuilderType $type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return Lombardot\FormBuilderBundle\Entity\FormBuilderType $type
     */
    public function getType()
    {
        return $this->type;
    }
}