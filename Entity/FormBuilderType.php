<?php 

namespace Lombardot\FormBuilderBundle\Entity;

/**
 * @orm:Entity
 * @orm:Table(name="formbuilder_type")
 */
class FormBuilderType
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
    private $class = null;
	
  

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
     * Set class
     *
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * Get class
     *
     * @return string $class
     */
    public function getClass()
    {
        return $this->class;
    }
}