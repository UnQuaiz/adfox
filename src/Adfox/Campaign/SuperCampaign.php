<?php

namespace AdFox\Campaigns;

use AdFox\AdFox;
use AdFox\Campaigns\Traits\HasStatus;

class SuperCampaign extends BaseObject{

	use HasStatus;
		
	/**
	 * Attributes that can be modified
	 *
	 * @var array
	 */
	protected $attributes = ['id', 'status'];

	/**
	 * SuperCampaign constructor.
	 *
	 * @param AdFox $adfox
	 * @param array $attributes
	 */
	public function __construct(AdFox $adfox, $attributes)
	{
		$this->id = $attributes['ID'];
		$this->status = $attributes['status'];

		parent::__construct($adfox);
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
	 * {@inheritdoc}
	 */
	protected function getType()
	{
		return AdFox::OBJECT_SUPERCAMPAIGN;
	}
}