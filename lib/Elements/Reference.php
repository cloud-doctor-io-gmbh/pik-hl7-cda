<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Address\PostalAddress;
use PHPHealth\CDA\RIM\Act\ExternalAct;

class Reference extends AbstractElement
{
    /**
     * @var ExternalAct
     */
    protected $externalAct;

    /**
     * @param ExternalAct $externalAct
     */
    public function __construct(ExternalAct $externalAct)
    {
        $this->externalAct = $externalAct;
    }

    public function getExternalAct(): ExternalAct
    {
        return $this->externalAct;
    }

    public function setExternalAct(ExternalAct $externalAct): Reference
    {
        $this->externalAct = $externalAct;
        return $this;
    }

    protected function getElementTag()
    {
        return 'reference';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el =  $this->createElement($doc);

        $el->appendChild($this->externalAct->toDOMElement($doc));

        return $el;
    }
}