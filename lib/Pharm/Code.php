<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\DataType\Code\CodedValue;

class Code extends AbstractPharmacyElement
{
    /**
     * @var CodedValue
     */
    protected $codedValue;

    public function __construct(CodedValue $codedValue)
    {
        $this->codedValue = $codedValue;
    }

    public function getCodedValue()
    {
        return $this->codedValue;
    }

    public function setCodedValue(CodedValue $codedValue)
    {
        $this->codedValue = $codedValue;
        return $this;
    }

    public function getElementTag()
    {
        return "code";
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $this->codedValue->setValueToElement($el, $doc);

        return $el;
    }
}