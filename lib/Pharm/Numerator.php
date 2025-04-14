<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;
use PHPHealth\CDA\Elements\AbstractElement;

class Numerator
{
    /**
     * @var PhysicalQuantity
     */
    protected $value;

    /**
     * @param PhysicalQuantity $value
     */
    public function __construct(PhysicalQuantity $value)
    {
        $this->value = $value;
    }

    public function getValue(): PhysicalQuantity
    {
        return $this->value;
    }

    public function setValue(PhysicalQuantity $value): Numerator
    {
        $this->value = $value;
        return $this;
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'numerator');

        $this->value->setValueToElement($el, $doc);

        $el->setAttributeNS(CDA::NS_XSI_URI, 'xsi:type', 'PQ');

        return $el;
    }
}