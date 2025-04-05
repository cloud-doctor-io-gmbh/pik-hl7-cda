<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Quantity\IntegerNumber;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class VersionNumber extends AbstractElement
{
    /**
     *
     * @var IntegerNumber
     */
    protected $value;

    public function __construct(IntegerNumber $value)
    {
        $this->setValue($value);
    }

    public function getValue(): IntegerNumber
    {
        return $this->value;
    }

    public function setValue(IntegerNumber $value): VersionNumber
    {
        $this->value = $value;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'versionNumber';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        return $this->createElement($doc, array('value'));
    }
}