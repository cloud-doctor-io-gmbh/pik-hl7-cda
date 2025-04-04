<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\ConceptDescriptor;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class ValueConceptDescriptor extends Code
{
    /**
     *
     * @var ConceptDescriptor
     */
    protected $value;

    public function __construct(ConceptDescriptor $value)
    {
        $this->setValue($value);
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('value'));
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(ConceptDescriptor $value)
    {
        $this->value = $value;
        return $this;
    }

    public function getElementTag()
    {
        return "value";
    }
}