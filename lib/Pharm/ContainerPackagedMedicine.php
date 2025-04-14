<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\HasClassCode;

class ContainerPackagedMedicine extends AbstractPharmacyElement implements HasClassCode, HasDeterminerCode
{
    /**
     * @var ?Code
     */
    protected $code;

    /**
     * @var ?Name
     */
    protected $name;

    /**
     * @var ?FormCode
     */
    protected $formCode;

    /**
     * @var CapacityQuantity
     */
    protected $capacity;

    /**
     * @var ?AsSuperContent
     */
    protected $asSuperContent;

    /**
     * @param Code $code
     * @param Name $name
     * @param CapacityQuantity $capacity
     */
    public function __construct(CapacityQuantity $capacity, Code $code = null, Name $name = null, FormCode $formCode = null, $asSuperContent = null)
    {
        $this->code = $code;
        $this->name = $name;
        $this->formCode = $formCode;
        $this->capacity = $capacity;
        $this->asSuperContent = $asSuperContent;
    }

    public function getCode(): Code
    {
        return $this->code;
    }

    public function setCode(Code $code): ContainerPackagedMedicine
    {
        $this->code = $code;
        return $this;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): ContainerPackagedMedicine
    {
        $this->name = $name;
        return $this;
    }

    public function getFormCode(): ?FormCode
    {
        return $this->formCode;
    }

    public function setFormCode(FormCode $formCode): ContainerPackagedMedicine
    {
        $this->formCode = $formCode;
        return $this;
    }

    public function getCapacity(): CapacityQuantity
    {
        return $this->capacity;
    }

    public function setCapacity(CapacityQuantity $capacity): ContainerPackagedMedicine
    {
        $this->capacity = $capacity;
        return $this;
    }

    public function getAsSuperContent(): ?AsSuperContent
    {
        return $this->asSuperContent;
    }

    public function setAsSuperContent(?AsSuperContent $asSuperContent): ContainerPackagedMedicine
    {
        $this->asSuperContent = $asSuperContent;
        return $this;
    }

    protected function getElementTag()
    {
        return 'containerPackagedMedicine';
    }

    public function getClassCode()
    {
        return 'CONT';
    }

    public function getDeterminerCode()
    {
        return 'INSTANCE';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        if ($this->code !== null) {
            $el->appendChild($this->code->toDOMElement($doc));
        }

        if ($this->name !== null) {
            $el->appendChild($this->name->toDOMElement($doc));
        }

        if ($this->formCode !== null) {
            $el->appendChild($this->formCode->toDOMElement($doc));
        }

        $el->appendChild($this->capacity?->toDOMElement($doc));

        if ($this->asSuperContent !== null) {
            $el->appendChild($this->asSuperContent->toDOMElement($doc));
        }

        return $el;
    }
}