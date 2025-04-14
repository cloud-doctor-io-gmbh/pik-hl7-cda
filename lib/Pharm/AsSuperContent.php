<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\HasClassCode;

class AsSuperContent extends AbstractPharmacyElement
{
    /**
     * @var ContainerPackagedMedicine
     */
    protected $containerPackagedMedicine;

    /**
     * @param ContainerPackagedMedicine $containerPackagedMedicine
     */
    public function __construct(ContainerPackagedMedicine $containerPackagedMedicine)
    {
        $this->containerPackagedMedicine = $containerPackagedMedicine;
    }

    public function getContainerPackagedMedicine(): ContainerPackagedMedicine
    {
        return $this->containerPackagedMedicine;
    }

    public function setContainerPackagedMedicine(ContainerPackagedMedicine $containerPackagedMedicine): AsSuperContent
    {
        $this->containerPackagedMedicine = $containerPackagedMedicine;
        return $this;
    }

    protected function getElementTag()
    {
        return 'asSuperContent';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->containerPackagedMedicine->toDOMElement($doc));

        return $el;
    }
}