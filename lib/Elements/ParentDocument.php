<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\DataType\Quantity\IntegerNumber;
use PHPHealth\CDA\HasTypeCode;

class ParentDocument extends AbstractElement
{
    /**
     * @var InstanceIdentifier
     */
    protected $id;

    /**
     * @var InstanceIdentifier
     */
    protected $setId;

    /**
     * @var IntegerNumber
     */
    protected $versionNumber;

    /**
     * @param InstanceIdentifier $id
     * @param InstanceIdentifier $setId
     * @param IntegerNumber $versionNumber
     */
    public function __construct(InstanceIdentifier $id, InstanceIdentifier $setId, IntegerNumber $versionNumber)
    {
        $this->id = $id;
        $this->setId = $setId;
        $this->versionNumber = $versionNumber;
    }

    public function getId(): InstanceIdentifier
    {
        return $this->id;
    }

    public function setId(InstanceIdentifier $id): ParentDocument
    {
        $this->id = $id;
        return $this;
    }

    public function getSetId(): InstanceIdentifier
    {
        return $this->setId;
    }

    public function setSetId(InstanceIdentifier $setId): ParentDocument
    {
        $this->setId = $setId;
        return $this;
    }

    public function getVersionNumber(): IntegerNumber
    {
        return $this->versionNumber;
    }

    public function setVersionNumber(IntegerNumber $versionNumber): ParentDocument
    {
        $this->versionNumber = $versionNumber;
        return $this;
    }

    protected function getElementTag()
    {
        return "parentDocument";
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el =  $this->createElement($doc);

        $el->appendChild((new Id($this->id))->toDOMElement($doc));
        $el->appendChild((new SetId($this->setId))->toDOMElement($doc));
        $el->appendChild((new VersionNumber($this->versionNumber))->toDOMElement($doc));

        return $el;
    }
}