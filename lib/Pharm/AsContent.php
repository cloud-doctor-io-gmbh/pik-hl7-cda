<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\HasClassCode;

class AsContent extends AbstractPharmacyElement implements HasClassCode
{
    /**
     * @var Set
     */
    protected $containerPackagedMedicines;

    /**
     * @param Set $containerPackagedMedicines
     */
    public function __construct(Set $containerPackagedMedicines)
    {
        $this->containerPackagedMedicines = $containerPackagedMedicines;
    }

    public function getContainerPackagedMedicines(): Set
    {
        return $this->containerPackagedMedicines;
    }

    public function setContainerPackagedMedicines(Set $containerPackagedMedicines): AsContent
    {
        $containerPackagedMedicines->checkContainsOrThrow(ContainerPackagedMedicine::class);
        $this->containerPackagedMedicines = $containerPackagedMedicines;
        return $this;
    }

    protected function getElementTag()
    {
        return 'asContent';
    }

    public function getClassCode()
    {
        return 'CONT';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $this->containerPackagedMedicines->setValueToElement($el, $doc);

        return $el;
    }
}