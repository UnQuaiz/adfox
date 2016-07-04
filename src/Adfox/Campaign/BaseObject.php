<?php
/**
 * Created by PhpStorm.
 * User: vleukhin
 * Date: 04.07.2016
 * Time: 14:07
 */

namespace AdFox\Campaigns;

use AdFox\AdFox;

abstract class BaseObject {

	/**
	 * Object ID
	 *
	 * @var int
	 */
	public $id = null;

	/**
	 * Adfox lib instance
	 *
	 * @var AdFox
	 */
	protected $adfox = null;

	/**
	 * Attributes that can be modified
	 *
	 * @var array
	 */
	protected $attributes = [];

	public function __construct(AdFox $adFox)
	{
		$this->adfox = $adFox;
	}

	/**
	 * Set AdFox instance to send requests to
	 *
	 * @param AdFox $adFox
	 */
	public function setAdfox(AdFox $adFox)
	{
		$this->adfox = $adFox;
	}

	/**
	 * Get array represent of Object.
	 *
	 * @return array
	 */
	public function toArray()
	{
		$array = [];

		foreach ($this->attributes as $property)
		{
			$array[$property] = $this->{$property};
		}

		return $array;
	}

	/**
	 * Save Object.
	 *
	 * @throws \AdFox\AdfoxException
	 */
	public function save()
	{
		$parameters = ['objectID' => $this->id] + $this->toArray();
		$this->adfox->callApi($this->getType(), AdFox::ACTION_MODIFY, null, $parameters);
	}

	/**
	 * Get Object type. String constant from AdFox class.
	 *
	 * @return string
	 */
	abstract protected function getType();
}