<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Api;

use Amocrmapi\Entity\Contact;
use Amocrmapi\V2\Traits\InitApiTrait;
use Amocrmapi\V2\Traits\SingletonTrait;
use Amocrmapi\V2\Traits\DefaultApiMethodsTrait;
use Amocrmapi\Dependencies\DefaultEntityApiInterface;

class ContactApi implements DefaultEntityApiInterface
{
	use SingletonTrait, InitApiTrait, DefaultApiMethodsTrait;

	const LINK = "/api/v2/contacts";
	const ENTITY_CLASS = Contact::class;
}
