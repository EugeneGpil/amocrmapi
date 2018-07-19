<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Api;

use Amocrmapi\Entity\Note;
use Amocrmapi\V2\Traits\InitApiTrait;
use Amocrmapi\V2\Traits\SingletonTrait;
use Amocrmapi\V2\Traits\DefaultApiMethodsTrait;
use Amocrmapi\Dependencies\DefaultEntityApiInterface;

class NoteApi implements DefaultEntityApiInterface
{
	use SingletonTrait, InitApiTrait, DefaultApiMethodsTrait;

	const LINK = "/api/v2/notes";
	const ENTITY_CLASS = Note::class;
}
