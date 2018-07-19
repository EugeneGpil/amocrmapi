<?php

declare(strict_types=1);

namespace Amocrmapi\Dependencies;

use Amocrmapi\Dependencies\EntityApiInterface;

interface DefaultEntityApiInterface extends EntityApiInterface
{
	public function add(array $entities) : array;
	public function get(array $params) : array;
	public function update(array $entities) : array;
	public function remove(array $entities) : array;
}