<?php

declare(strict_types=1);

namespace Amocrmapi\Entity;

use Amocrmapi\Dependencies\EntityInterface;

class Note implements EntityInterface
{
	/**
	 * @var array $entity = []
	 */
	private $entity;

    public function __construct()
    {
        $this->entity = [
            "id" => null,
            "responsible_user_id" => null,
            "created_by" => null,
            "created_at" => null,
            "updated_at" => null,
            "account_id" => null,
            "group_id" => null,
            "is_editable" => null,
            "element_id" => null,
            "element_type" => null,
            "attachment" => null,
            "note_type" => null,
            "text" => null
        ];
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
     * Parse lead entity from amocrm response
     * 
     * @param array @data
     * 
     * @return \Amocrmapi\Entity\Note
     */
    public function parse(array $data) : \Amocrmapi\Entity\Note
    {
        foreach ($data as $ind => $val) {
            $this->entity[$ind] = $val;
        }

    	return $this;
    }

    public function getId()
    {
        return $this->entity["id"];
    }

    public function setId($id)
    {
        $this->entity["entity"]["id"] = $id;

        return $this;
    }

    public function getResponsibleUserId()
    {
        return $this->entity["responsible_user_id"];
    }

    public function setResponsibleUserId($responsibleUserId)
    {
        $this->entity["responsible_user_id"] = $responsibleUserId;

        return $this;
    }

    public function getCreatedBy()
    {
        return $this->entity["created_by"];
    }

    public function setCreatedBy($createdBy)
    {
        $this->entity["created_by"] = $createdBy;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->entity["created_at"];
    }

    public function setCreatedAt($createdAt)
    {
        $this->entity["created_at"] = $createdAt;

        return $this;
    }

    public function getUpdatedAt()
    {
        return $this->entity["updated_at"];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->entity["updated_at"] = $updatedAt;

        return $this;
    }

    public function getAccountId()
    {
        return $this->entity["account_id"];
    }

    public function setAccountId($accountId)
    {
        $this->entity["account_id"] = $accountId;

        return $this;
    }

    public function getGroupId()
    {
        return $this->entity["group_id"];
    }

    public function setGroupId($groupId)
    {
        $this->entity["group_id"] = $groupId;

        return $this;
    }

    public function getIsEditable()
    {
        return $this->entity["is_editable"];
    }

    public function setIsEditable($isEditable)
    {
        $this->entity["is_editable"] = $isEditable;

        return $this;
    }

    public function getElementId()
    {
        return $this->entity["element_id"];
    }

    public function setElementId($elementId)
    {
        $this->entity["element_id"] = $elementId;

        return $this;
    }

    public function getElementType()
    {
        return $this->entity["element_type"];
    }

    public function setElementType($elementType)
    {
        switch ($elementType) {
            case 'contact':
            case '1':
                $this->entity["element_type"] = 1;
                break;

            case 'lead':
            case '2':
                $this->entity["element_type"] = 2;
                break;

            case 'company':
            case '3':
                $this->entity["element_type"] = 3;
                break;

            case 'task':
            case '4':
                $this->entity["element_type"] = 4;
                break;

            case 'customer':
            case '12':
                $this->entity["element_type"] = 12;
        }

        return $this;
    }

    public function getAttachment()
    {
        return $this->entity["attachment"];
    }

    public function setAttachment($attachment)
    {
        $this->entity["attachment"] = $attachment;

        return $this;
    }

    public function getNoteType()
    {
        return $this->entity["note_type"];
    }

    public function setNoteType(string $noteType)
    {
        switch ($noteType) {
            case 'DEAL_CREATED':
            case 'lead created':
            case '1':
                $this->entity["note_type"] = 1;
                break;

            case 'CONTACT_CREATED':
            case 'contact created':
            case '2':
                $this->entity["note_type"] = 2;
                break;

            case 'DEAL_STATUS_CHANGED':
            case 'pipeline change':
            case '3':
                $this->entity["note_type"] = 3;
                break;

            case 'COMMON':
            case 'default':
            case '4':
                $this->entity["note_type"] = 4;
                break;

            case 'CALL_IN':
            case 'call in':
            case '10':
                $this->entity["note_type"] = 10;
                break;

            case 'CALL_OUT':
            case 'call out':
            case '11':
                $this->entity["note_type"] = 11;
                break;

            case 'COMPANY_CREATED':
            case 'company created':
            case '12':
                $this->entity["note_type"] = 12;
                break;

            case 'TASK_RESULT':
            case 'task result':
            case '13':
                $this->entity["note_type"] = 12;
                break;

            case 'SYSTEM':
            case 'system':
            case 'system message':
            case '25':
                $this->entity["note_type"] = 25;
                break;

            case 'SMS_IN':
            case 'sms in':
            case '102':
                $this->entity["note_type"] = 102;
                break;

            case 'SMS_OUT':
            case 'sms out':
            case '103':
                $this->entity["note_type"] = 103;
                break;
        }

        return $this;
    }

    public function getText()
    {
        return $this->entity["text"];
    }

    public function setText($text)
    {
        $this->entity["text"] = $text;

        return $this;
    }

    public function getLinks()
    {
        return $this->entity["links"];
    }
}