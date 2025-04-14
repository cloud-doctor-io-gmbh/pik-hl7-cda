<?php

namespace PHPHealth\CDA\RIM\Act;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\HasTypeCode;
use PHPHealth\CDA\RIM\Role\AssignedEntity;

class Performer2 extends AbstractElement implements HasTypeCode
{
    /**
     * @var AssignedEntity
     */
    private $assignedEntity;

    /**
     * @param AssignedEntity $assignedEntity
     */
    public function __construct(AssignedEntity $assignedEntity)
    {
        $this->assignedEntity = $assignedEntity;
    }

    public function getAssignedEntity(): AssignedEntity
    {
        return $this->assignedEntity;
    }

    public function setAssignedEntity(AssignedEntity $assignedEntity): Performer2
    {
        $this->assignedEntity = $assignedEntity;
        return $this;
    }

    public function getTypeCode()
    {
        return 'PRF';
    }

    protected function getElementTag()
    {
        return 'performer';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->assignedEntity->toDOMElement($doc));

        return $el;
    }
}