<?php

namespace PHPHealth\CDA\ExtPL;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\HasClassCode;
use PHPHealth\CDA\HasTypeCode;

class Bounding extends AbstractExtPLElement implements HasTypeCode
{
    /**
     * @var Reimburser
     */
    protected $reimburser;

    public function __construct(Reimburser $reimburser)
    {
        $this->reimburser = $reimburser;
    }

    protected function getElementTag()
    {
        return 'bounding';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el =  $this->createElement($doc);

        $el->appendChild($this->reimburser->toDOMElement($doc));

        return $el;
    }

    public function getTypeCode()
    {
        return 'PART';
    }
}