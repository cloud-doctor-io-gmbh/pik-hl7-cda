<?php

namespace PHPHealth\CDA\Pharm;

class Quantity extends AbstractPharmacyElement
{
    /**
     * @var Numerator
     */
    protected $numerator;

    /**
     * @var Denominator
     */
    protected $denominator;

    /**
     * @param Numerator $numerator
     * @param Denominator $denominator
     */
    public function __construct(Numerator $numerator, Denominator $denominator)
    {
        $this->numerator = $numerator;
        $this->denominator = $denominator;
    }

    public function getNumerator(): Numerator
    {
        return $this->numerator;
    }

    public function setNumerator(Numerator $numerator): Quantity
    {
        $this->numerator = $numerator;
        return $this;
    }

    public function getDenominator(): Denominator
    {
        return $this->denominator;
    }

    public function setDenominator(Denominator $denominator): Quantity
    {
        $this->denominator = $denominator;
        return $this;
    }

    protected function getElementTag()
    {
        return 'quantity';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $el->appendChild($this->numerator->toDOMElement($doc));
        $el->appendChild($this->denominator->toDOMElement($doc));

        return $el;
    }
}