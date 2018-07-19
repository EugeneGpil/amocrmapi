<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Traits;

/**
 * Singleton realisation for api classes
 */
trait InitApiTrait
{
	/**
	 * @var \Amocrmapi\V2\API
	 */
	private $api;

	public function init($api)
	{
		$this->api = $api;

		return $this;
	}
}