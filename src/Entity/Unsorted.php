<?php

declare(strict_types=1);

namespace Amocrmapi\Entity;

use Amocrmapi\Traits\EntityTrait;
use Amocrmapi\Dependencies\EntityInterface;

class Unsorted implements EntityInterface
{
	const DEFAULT_SOURCE_NAME = "amoapi source name";
    const DEFAULT_FORM_NAME = "amoapi form name";
    const DEFAULT_FORM_PAGE = "amoapi form page";
    const DEFAULT_IP = "0.0.0.0";
    const DEFAULT_REFERER = "amoapi referer";
    const DEFAULT_FROM = "amoapi from";
    const DEFAULT_DURATION = '0';
    const DEFAULT_LINK = "amoapi link";

    /**
     * @var array $entity
     */
    private $entity;

    public function __construct()
	{
		$this->entity = [
            'source_name' => self::DEFAULT_SOURCE_NAME,
            'source_uid' => sha1("amoapi_source_uid" . time()),
            'pipeline_id' => "0",
            'created_at' => time(),
            'incoming_entities' => [
                "leads" => [["custom_fields" => []]],
                "contacts" => [["custom_fields" => []]],
                "companies" => [["custom_fields" => []]]
            ],
            "incoming_lead_info" => [
                // form
                "form_id" => time(),
                "form_page" => self::DEFAULT_FORM_PAGE,
                "ip" => self::DEFAULT_IP,
                "service_code" => sha1("amoapi_service_code" . time()),
                "form_name" => self::DEFAULT_FORM_NAME,
                "form_send_at" => time(),
                "referer" => self::DEFAULT_REFERER,

                //sip
                'to' => time(),
                'from' => self::DEFAULT_FROM,
                'date_call' => time(),
                'duration' => self::DEFAULT_DURATION,
                'link' => self::DEFAULT_LINK,
                'uniq' => sha1("amoapi_uniq" . time()),
                'addNote' => false,
            ]
        ];
    }

	/**
     * Parse lead entity from amocrm response
     * 
     * @param array @data
     * 
     * @return \Amocrmapi\Entity\Unsorted
     */
    public function parse(array $data) : \Amocrmapi\Entity\Unsorted
    {
        foreach ($data as $ind => $val) {
            $this->entity[$ind] = $val;
        }

    	return $this;
    }

    /**
     * Prepare entity to sync with amocrm
     * 
     * @return array
     */
    public function prepare() : array
    {
        return $this->entity;
    }

    /**
     * Add unsorted note
     * 
     * @param string $text
     * @param string $entityType
     * @param int $noteType = 4 - common note
     */
    public function addNote(string $text, string $entityType = "lead", int $noteType = 4)
    {
        $this->entity["incoming_entities"]["leads"][0]["notes"][] = [
            "note_type" => $noteType,
            "element_type" => $entityType,
            "text" => $text
        ];

        return $this;
    }
   
   /**
    * Set unsorted lead
    * 
    * @param \AmocrmApi\Entity\Lead $lead
    */
    public function setLead(\AmocrmApi\Entity\Lead $lead)
    {
        $this->entity["incoming_entities"]["leads"][0] = $lead->prepare();

        return $this;
    }

    /**
     * Set unsorted 
     * 
     * @param \AmocrmApi\Entity\Contact $contact
     */
    public function setContact(\AmocrmApi\Entity\Contact $contact)
    {
        $this->entity["incoming_entities"]["contacts"][0] = $contact->prepare();

        return $this;
    }

    /**
     * Set unsorted 
     * 
     * @param \AmocrmApi\Entity\Company $company
     */
    public function setCompany(\AmocrmApi\Entity\Company $company)
    {
        $this->entity["incoming_entities"]["companies"][0] = $company->prepare();

        return $this;
    }

    /**
     * Set unsorted sourceName
     * 
     * @param string $sourceName
     */
    public function setSourceName(string $sourceName)
    {
        $this->entity["sourceName"] = $sourceName;
    
        return $this;
    }

    /**
     * Set unsorted sourceUid
     * 
     * @param string $sourceUid
     */
    public function setSourceUid(string $sourceUid)
    {
        $this->entity["sourceUid"] = $sourceUid;
    
        return $this;
    }

    /**
     * Set unsorted pipelineId
     * 
     * @param string $pipelineId
     */
    public function setPipelineId(string $pipelineId)
    {
        $this->entity["pipelineId"] = $pipelineId;
    
        return $this;
    }

    /**
     * Set unsorted 
     * 
     * @param int $formId
     */
    public function setFormId(int $formId)
    {
        $this->entity["formId"] = $formId;
    
        return $this;
    }

    /**
     * Set unsorted formPage
     * 
     * @param string $formPage
     */
    public function setFormPage(string $formPage)
    {
        $this->entity["formPage"] = $formPage;
    
        return $this;
    }

    /**
     * Set unsorted ip
     * 
     * @param string $ip
     */
    public function setIp(string $ip)
    {
        $this->entity["ip"] = $ip;
    
        return $this;
    }

    /**
     * Set unsorted serviceCode
     * 
     * @param string $serviceCode
     */
    public function setServiceCode(string $serviceCode)
    {
        $this->entity["serviceCode"] = $serviceCode;
    
        return $this;
    }

    /**
     * Set unsorted formName
     * 
     * @param string $formName
     */
    public function setFormName(string $formName)
    {
        $this->entity["formName"] = $formName;
    
        return $this;
    }

    /**
     * Set unsorted 
     * 
     * @param int $formSendAt
     */
    public function setFormSendAt(int $formSendAt)
    {
        $this->entity["formSendAt"] = $formSendAt;
    
        return $this;
    }

    /**
     * Set unsorted referer
     * 
     * @param string $referer
     */
    public function setReferer(string $referer)
    {
        $this->entity["referer"] = $referer;
    
        return $this;
    }

    /**
     * Set unsorted to
     * 
     * @param int $to
     */
    public function setTo(int $to)
    {
        $this->entity["to"] = $to;

        return $this;
    }

    /**
     * Set unsorted from
     * 
     * @param string $from
     */
    public function setFrom(string $from)
    {
        $this->entity["from"] = $from;

        return $this;
    }

    /**
     * Set unsorted dateCall
     * 
     * @param int $dateCall
     */
    public function setDateCall(int $dateCall)
    {
        $this->entity["dateCall"] = $dateCall;

        return $this;
    }

    /**
     * Set unsorted duration
     * 
     * @param string $duration
     */
    public function setDuration(string $duration)
    {
        $this->entity["duration"] = $duration;

        return $this;
    }

    /**
     * Set unsorted link
     * 
     * @param string $link
     */
    public function setLink(string $link)
    {
        $this->entity["link"] = $link;

        return $this;
    }

    /**
     * Set unsorted uniq
     * 
     * @param string $uniq
     */
    public function setUniq(string $uniq)
    {
        $this->entity["uniq"] = $uniq;

        return $this;
    }

    /**
     * Set unsorted addNote
     * 
     * @param string $addNote
     */
    public function setAddNote(string $addNote)
    {
        $this->entity["addNote"] = $addNote;

        return $this;
    }
}