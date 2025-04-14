<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\HasClassCode;

class ActiveIngredient extends AbstractPharmacyElement implements HasClassCode
{
    /**
     * @var Quantity
     */
    protected $quantity;

    /**
     * @var ManufacturedMaterialIngredient
     */
    protected $manufacturedMaterialIngredient;

    /**
     * @param Quantity $quantity
     * @param ManufacturedMaterialIngredient $manufacturedMaterialIngredient
     */
    public function __construct(Quantity $quantity, ManufacturedMaterialIngredient $manufacturedMaterialIngredient)
    {
        $this->quantity = $quantity;
        $this->manufacturedMaterialIngredient = $manufacturedMaterialIngredient;
    }

    public function getQuantity(): Quantity
    {
        return $this->quantity;
    }

    public function setQuantity(Quantity $quantity): ActiveIngredient
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getManufacturedMaterialIngredient(): ManufacturedMaterialIngredient
    {
        return $this->manufacturedMaterialIngredient;
    }

    public function setManufacturedMaterialIngredient(ManufacturedMaterialIngredient $manufacturedMaterialIngredient): ActiveIngredient
    {
        $this->manufacturedMaterialIngredient = $manufacturedMaterialIngredient;
        return $this;
    }

    public function getClassCode()
    {
        return 'ACTI';
    }

    protected function getElementTag()
    {
        return 'ingredient';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->quantity->toDOMElement($doc));
        $el->appendChild($this->manufacturedMaterialIngredient->toDOMElement($doc));

        return $el;
    }

}