<?php

namespace AdFox\Campaigns\Banner;

use AdFox\AdFox;
use AdFox\Campaigns\BaseObject;

class Type extends BaseObject{

	/**
	 * BannerType name
	 *
	 * @var string
	 */
	public $name;

	/**
	 * Templates of this banner type
	 *
	 * @var Template[]
	 */
	public $templates = [];

	/**
	 * Attributes that can be modified
	 *
	 * @var array
	 */
	protected $attributes = ['id', 'name'];

	/**
	 * BannerType constructor.
	 *
	 * @param AdFox $adFox
	 * @param array $attributes
	 * @param array $relations
	 */
	public function __construct(AdFox $adFox, $attributes, $relations = [])
	{
		parent::__construct($adFox);

		$this->id = $attributes['ID'];
		$this->name = $attributes['name'];

		$this->loadRelations($relations);
	}

	/**
	 * Loads templates of this banner type
	 *
	 * @throws \AdFox\AdfoxException
	 */
	protected function loadTemplates()
	{
		$response = $this->adfox->callApi(AdFox::OBJECT_BANNER_TYPE, AdFox::ACTION_LIST, AdFox::OBJECT_BANNER_TEMPLATE, ['objectID' => $this->id]);
		foreach ($response->data->children() as $templatetData)
		{
			$template = new Template($this->adfox, (array) $templatetData);
			$this->templates[] = $template;
		}
	}


	/**
	 * Find template if this type by id
	 *
	 * @param $name
	 * @return Template|null
	 */
	public function findeTemplate($name)
	{
		if (empty($this->templates))
		{
			$this->loadTemplates();
		}

		foreach ($this->templates as $template)
		{
			if ($template->name == $name)
			{
				return $template;
			}
		}

		return null;
	}

	/**
	 * Get Object type. String constant from AdFox class.
	 *
	 * @return string
	 */
	protected function getType()
	{
		return AdFox::OBJECT_BANNER_TYPE;
	}
}