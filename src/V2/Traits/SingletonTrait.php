<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Traits;

/**
 * Singleton realisation for api classes
 */
trait SingletonTrait
{
	private static $instance = null;

	public static function getInstance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __clone() {}
	public function __sleep() {}
	public function __wakeup() {}
	public function __construct() {}
}