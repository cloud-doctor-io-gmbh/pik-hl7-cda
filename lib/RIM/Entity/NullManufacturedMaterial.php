<?php

namespace PHPHealth\CDA\RIM\Entity;

class NullManufacturedMaterial extends DrugOrMaterial
{

    protected function getElementTag()
    {
        return 'manufacturedMaterial';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);
        $el->setAttribute("nullFlavor", 'NA');
        return $el;
    }

    public function getDefaultClassCode()
    {
        return 'MMAT';
    }
}