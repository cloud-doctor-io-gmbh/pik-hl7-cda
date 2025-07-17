<?php

namespace PHPHealth\CDA\ExtPL;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\HasClassCode;
use PHPHealth\CDA\HasMoodCodeInterface;

class ReimbursementRelatedContract extends AbstractExtPLElement implements HasClassCode, HasMoodCodeInterface
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var Bounding
     */
    protected $bounding;

    public function __construct(Id $id, Bounding $bounding)
    {
        $this->id = $id;
        $this->bounding = $bounding;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function setId(Id $id): ReimbursementRelatedContract
    {
        $this->id = $id;
        return $this;
    }

    public function getBounding(): Bounding
    {
        return $this->bounding;
    }

    public function setBounding(Bounding $bounding): ReimbursementRelatedContract
    {
        $this->bounding = $bounding;
        return $this;
    }

    protected function getElementTag()
    {
        return 'reimbursementRelatedContract';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->id->toDOMElement($doc));
        $el->appendChild($this->bounding->toDOMElement($doc));

        return $el;
    }

    public function getClassCode()
    {
        return 'CNTRCT';
    }

    public function getMoodCode()
    {
        return 'EVN';
    }
}