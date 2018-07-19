<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Api;

use Amocrmapi\Entity\Lead;
use Amocrmapi\V2\Traits\InitApiTrait;
use Amocrmapi\V2\Traits\SingletonTrait;
use Amocrmapi\V2\Traits\DefaultApiMethodsTrait;
use Amocrmapi\Dependencies\DefaultEntityApiInterface;

class LeadApi implements DefaultEntityApiInterface
{
	use SingletonTrait, InitApiTrait, DefaultApiMethodsTrait;

	const LINK = "/api/v2/leads";
	const ENTITY_CLASS = Lead::class;
}
