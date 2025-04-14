<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\HasClassCode;

class ManufacturedMaterialIngredient extends AbstractPharmacyElement implements HasClassCode, HasDeterminerCode
{
    /**
     * @var Name
     */
    protected $name;

    /**
     * @param Name $name
     */
    public function __construct(Name $name)
    {
        $this->name = $name;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): ManufacturedMaterialIngredient
    {
        $this->name = $name;
        return $this;
    }

    public function getClassCode()
    {
        return 'MMAT';
    }

    public function getDeterminerCode()
    {
        return 'KIND';
    }

    protected function getElementTag()
    {
        return 'ingredient';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->name->toDOMElement($doc));

        return $el;
    }

}