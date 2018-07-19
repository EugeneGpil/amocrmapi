<?php

declare(strict_types=1);

namespace Amocrmapi\Dependencies;


interface EntityInterface
{
	public function prepare() : array;
	public function parse(array $data);
}