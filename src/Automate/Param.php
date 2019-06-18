<?php
namespace Automate;

require_once __DIR__ . '/../../vendor/autoload.php';

/**
 * 
 */
class Param 
{
	
	private $type

	
	private $name
	public function __construct(array $data)
	{
		if (is_array($data)&& !empty($data)) {
			$this->hydrate($data);
		}
	}

	public function hydrate(array $data)
	{
		if (is_array($data)&& !empty($data)) {
			$this->type = $data['type'];
			$this->name = $data['name'];
		}
	}

	public function name()
	{
		return $this->name;
	}

	public function type()
	{
		return $this->type;
	}




}