<?php

namespace PHPHealth\CDA\DataType\Code;

use PHPHealth\CDA\Elements\NameCodedValue;
use PHPHealth\CDA\Elements\ValueConceptDescriptor;

/**
 * See https://www.hl7.org/cda/stds/core/draft1/StructureDefinition-CR.html:
 * A concept qualifier code with optionally named role. Both qualifier role and value codes must be defined by the
 * coding system of the CD containing the concept qualifier. For example, if SNOMED RT defines a concept “leg”,
 * a role relation “has-laterality”, and another concept “left”, the concept role relation allows to add the qualifier
 * “has-laterality: left” to a primary code “leg” to construct the meaning “left leg”.
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class ConceptRole extends \PHPHealth\CDA\DataType\AnyType
{
    /**
     *
     * @var NameCodedValue
     */
    private $name;

    /**
     *
     * @var ValueConceptDescriptor
     */
    private $value;

    public function __construct(NameCodedValue $name = null, ValueConceptDescriptor $value = null)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function hasName()
    {
        return !empty($this->getName());
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function hasValue()
    {
        return !empty($this->getValue());
    }

    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        if ($this->hasName()) {
            $el->appendChild($this->getName()->toDOMElement($doc));
        }

        if ($this->hasValue()) {
            $el->appendChild($this->getValue()->toDOMElement($doc));
        }
    }
}