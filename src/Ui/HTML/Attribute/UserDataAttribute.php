<?php


namespace Ui\HTML\Attribute;


class UserDataAttribute
{
	private string $name = '';
	/**
	 * @var mixed
	 */
	private $value;

	/**
	 * UserDataAttribute constructor.
	 * @param string $name
	 * @param mixed $value
	 */
	public function __construct(string $name, $value)
	{
		if (!strpos($name, 'data-') === 0) {
			throw new \Exception('Invalid user data attribute : ' . $name . 'user data attributes must start with data-');
		}
		$this->name = $name;
		$this->value = $value;
	}

	public function __toString()
	{
		return $this->name . '="' . $this->value . '"';
	}
}