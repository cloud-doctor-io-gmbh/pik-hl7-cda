<?php

namespace PHPHealth\CDA\ExtPL;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\HasClassCode;
use PHPHealth\CDA\HasTypeCode;

class Reimburser extends AbstractExtPLElement implements HasClassCode
{
    /**
     * @var Id
     */
    protected $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function setId(Id $id): Reimburser
    {
        $this->id = $id;
        return $this;
    }

    protected function getElementTag()
    {
        return 'reimburser';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->id->toDOMElement($doc));

        return $el;
    }

    public function getClassCode()
    {
        return 'UNDWRT';
    }
}