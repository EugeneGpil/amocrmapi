<?php

declare(strict_types=1);

namespace Amocrmapi\V2\Api;

use Amocrmapi\Entity\Unsorted;
use Amocrmapi\V2\Traits\InitApiTrait;
use Amocrmapi\V2\Traits\SingletonTrait;
use Amocrmapi\V2\Traits\DefaultApiMethodsTrait;
use Amocrmapi\Dependencies\DefaultEntityApiInterface;

class UnsortedApi implements DefaultEntityApiInterface
{
	use SingletonTrait, InitApiTrait, DefaultApiMethodsTrait;

	const FORM_LINK = "/api/v2/incoming_leads/form";
    const SIP_LINK = "/api/v2/incoming_leads/sip";
    const LINK = "/api/v2/incoming_leads";
	const ENTITY_CLASS = Task::class;

    /**
     * Add unsorted to amocrm
     * 
     * @param array $entities
     * @param bool $sip = false
     * 
     * @throws Amocrmapi\Exceptions\RequestException
     * 
     * @return array
     */
    public function add(array $entities, $sip = false) : array
    {
    	foreach ($entities as $entity) {
            $data["add"][] = $entity->prepare();
        }
        
        $data = $this->api->request(
            $sip ? self::SIP_LINK : self::FORM_LINK,
            $data,
            "POST",
            true
        );;

        if (!isset($data['status']) || $data["status"] !== "success") {
            throw new RequestException(
                $data["incoming_leads"]["error"] ?? $data["error"],
                400);
        }

        return $data;
    }

    /**
     * Update unavailable for unsorted api V2
     * 
     * @param array $entities
     * 
     * @return array
     */
    public function update(array $entities) : array
    {
    	return [];
    }

     /**
     * Remove unsorted form amocrm
     * 
     * @todo research and realize realization of remove method
     * 
     * @param array $params
     * 
     * @return array
     */
    public function remove(array $params) : array
    {
    	return ["status" => "TODO"];
    }
}
