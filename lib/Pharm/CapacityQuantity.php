<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;

class CapacityQuantity extends AbstractPharmacyElement
{
    /**
     * @var PhysicalQuantity
     */
    protected $capacity;

    /**
     * @param PhysicalQuantity $capacity
     */
    public function __construct(PhysicalQuantity $capacity)
    {
        $this->capacity = $capacity;
    }

    public function getCapacity(): PhysicalQuantity
    {
        return $this->capacity;
    }

    public function setCapacity(PhysicalQuantity $capacity): CapacityQuantity
    {
        $this->capacity = $capacity;
        return $this;
    }

    protected function getElementTag()
    {
        return 'capacityQuantity';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $this->capacity->setValueToElement($el, $doc);

        return $el;
    }
}