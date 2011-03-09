<?php 

namespace Lombardot\FormBuilderBundle\Services\JSON;

/**
 * This class save a form definition into a stuctured JSON
 * @author cedric
 *
 */
class FormDescriptionReader
{
	
	/**
	 * @var string $Id the json id
	 */
	protected $Id;
	
	/**
	 * @var string $FormName the formName
	 */
	protected $FormName;
	
	/**
	 * @var string $CreatedAt the creation date
	 */
	protected $CreatedAt;
	
	/**
	 * @var string $Description the description date
	 */
	protected $Description;
	
	/**
	 * Set the json id
	 * @param string $id
	 */
	public function setId($Id)
	{
		$this->$Id = $Id;
		return $this;
	}
	
	/**
	 * get the setted json ID
	 * @return string the json id
	 */
	public function getId()
	{
		return $this->Id;
	}
	
	/**
	 * Change the form name
	 * @param string $FormName
	 */
	public function setFormName($FormName) 
	{
		$this->FormName = $FormName;
		return $this;
	}
	
	/**
	 * get the setted form name
	 * @return string the form name
	 */
	public function getFormName()
	{
		return $this->FormName;
	}
	
	/**
	 * Change the created At 
	 * @param string $CreatedAt
	 */
	public function setCreatedAt($CreatedAt) 
	{
		$this->CreatedAt = $CreatedAt;
		return $this;
	}
	
	/**
	 * get the setted created At
	 * @return string the created At
	 */
	public function getCreatedAt()
	{
		return $this->CreatedAt;
	}
	
	/**
	 * Change the description string
	 * @param string $Description
	 */
	public function setDescription($Description) 
	{
		$this->Description = $Description;
		return $this;
	}
	
	/**
	 * get the setted Description
	 * @return string the Description
	 */
	public function getDescription()
	{
		return $this->Description;
	}
	
	/**
	 * Get current date for updated At
	 * @return string the current date
	 */
	public function getUpdatedAt()
	{
		return time();
	}
	
	/**
	 * import the xml
	 * @param string json the input json
	 * @return $this
	 */
	public function import($json)
	{
		$json =  json_decode($json, true);
		foreach ($json['FormBuilder'] as $property=>$value)
		{
			$this->$property = $value;
		}
		return $this;
	}
	
	/**
	 * Save JSON into the defined directory under id.json
	 */
	public function readJson()
	{
	}
}
?>