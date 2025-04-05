<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\CodedWithEquivalents;

class FunctionCode extends AbstractElement
{
    /**
     *
     * @var CodedWithEquivalents
     */
    protected $code;

    public function __construct(CodedWithEquivalents $code)
    {
        $this->setCode($code);
    }

    public function getCode(): CodedWithEquivalents
    {
        return $this->code;
    }

    public function setCode(CodedWithEquivalents $code): FunctionCode
    {
        $this->code = $code;
        return $this;
    }


    protected function getElementTag()
    {
        return 'functionCode';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, array('code'));
    }
}