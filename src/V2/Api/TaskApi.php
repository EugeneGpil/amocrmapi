<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Api;

use Amocrmapi\Entity\Task;
use Amocrmapi\V2\Traits\InitApiTrait;
use Amocrmapi\V2\Traits\SingletonTrait;
use Amocrmapi\V2\Traits\DefaultApiMethodsTrait;
use Amocrmapi\Dependencies\DefaultEntityApiInterface;

class TaskApi implements DefaultEntityApiInterface
{
	use SingletonTrait, InitApiTrait, DefaultApiMethodsTrait;

	const LINK = "/api/v2/tasks";
	const ENTITY_CLASS = Task::class;
}
