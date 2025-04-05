<?php

namespace PHPHealth\CDA\DataType\Address;

use PHPHealth\CDA\DataType\AnyType;

class TelecommunicationAddress extends AnyType
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $use;

    public function __construct($value = null, $use = null)
    {
        $this->value = $value;
        $this->use = $use;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): TelecommunicationAddress
    {
        $this->value = $value;
        return $this;
    }

    public function hasValue(): bool
    {
        return !empty($this->value);
    }

    public function getUse(): string
    {
        return $this->use;
    }

    public function setUse(string $use): TelecommunicationAddress
    {
        $this->use = $use;
        return $this;
    }

    public function hasUse(): bool
    {
        return !empty($this->use);
    }

    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        if ($this->hasValue()) {
            $el->setAttribute('value', $this->getValue());
        }

        if ($this->hasUse()) {
            $el->setAttribute('use', $this->getUse());
        }
    }
}