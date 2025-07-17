<?php

namespace PHPHealth\CDA\ExtPL;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\ElementInterface;
use PHPHealth\CDA\HasClassCode;
use PHPHealth\CDA\HasMoodCodeInterface;
use PHPHealth\CDA\HasTypeCode;
use PHPHealth\CDA\Pharm\DOMElement;
use PHPHealth\CDA\Pharm\HasDeterminerCode;

abstract class AbstractExtPLElement implements ElementInterface
{
    /**
     * get the element tag name
     *
     * @return string
     */
    abstract protected function getElementTag();

    /**
     * create an element with the tag given by self::getElementTag and
     * apply this element to datatype given by $properties
     *
     * @param \DOMDocument $doc
     * @param string[] $properties the name of the properties to apply on element
     * @return \DOMElement
     */
    protected function createElement(\DOMDocument $doc, array $properties = array())
    {
        /* @var $el DOMElement */
        $el = $doc->createElementNS(ExtPL::NS_URI, ExtPL::NS_PREFIX.$this->getElementTag());

        if ($this instanceof HasClassCode) {
            if (! empty($this->getClassCode())) {
                $el->setAttribute(CDA::NS_CDA.'classCode', $this->getClassCode());
            }
        }

        if ($this instanceof HasTypeCode) {
            if (! empty($this->getTypeCode())) {
                $el->setAttribute(CDA::NS_CDA.'typeCode', $this->getTypeCode());
            }
        }

        if ($this instanceof HasMoodCodeInterface) {
            $el->setAttribute(CDA::NS_CDA.'moodCode', $this->getMoodCode());
        }

        if ($this instanceof HasDeterminerCode) {
            if (!empty($this->getDeterminerCode())) {
                $el->setAttribute(CDA::NS_CDA.'determinerCode', $this->getDeterminerCode());
            }
        }

        if (count($properties) > 0) {
            foreach ($properties as $property) {
                $this->{$property}?->setValueToElement($el, $doc);
            }
        }

        return $el;
    }
}