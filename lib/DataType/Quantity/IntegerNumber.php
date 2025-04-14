<?php

namespace PHPHealth\CDA\DataType\Quantity;

use PHPHealth\CDA\ClinicalDocument as CD;

class IntegerNumber extends AbstractQuantity
{
    /**
     *
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setValue(int $value): IntegerNumber
    {
        $this->value = $value;
        return $this;
    }

    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        $el->setAttribute('value', $this->getValue());
    }
}