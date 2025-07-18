<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Address\PostalAddress;
use PHPHealth\CDA\HasTypeCode;
use PHPHealth\CDA\RIM\Act\ExternalAct;

class Reference extends AbstractElement implements HasTypeCode
{
    /**
     * @var ExternalAct|ExternalDocument
     */
    protected $externalReference;

    /**
     * @param ExternalAct|ExternalDocument $externalReference
     */
    public function __construct(ExternalAct|ExternalDocument $externalReference)
    {
        $this->externalReference = $externalReference;
    }

    public function getExternalReference(): ExternalAct|ExternalDocument
    {
        return $this->externalReference;
    }

    public function setExternalReference(ExternalAct|ExternalDocument $externalReference): Reference
    {
        $this->externalReference = $externalReference;
        return $this;
    }

    protected function getElementTag()
    {
        return 'reference';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el =  $this->createElement($doc);

        $el->appendChild($this->externalReference->toDOMElement($doc));

        return $el;
    }

    public function getTypeCode()
    {
        return 'REFR';
    }
}