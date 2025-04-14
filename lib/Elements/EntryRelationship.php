<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\HasTypeCode;
use PHPHealth\CDA\RIM\Act\Act;

class EntryRelationship extends AbstractElement implements HasTypeCode
{
    /**
     * @var string
     */
    private $typeCode;

    /**
     * @var SequenceNumber|null
     */
    protected $sequenceNumber;

    /**
     * @var Act
     */
    protected $act;

    /**
     * @var bool|null
     */
    protected $inversionIndication = null;

    /**
     * @param Act $act
     * @param SequenceNumber|null $sequenceNumber
     */
    public function __construct(Act $act, SequenceNumber|null $sequenceNumber = null)
    {
        $this->sequenceNumber = $sequenceNumber;
        $this->act = $act;
    }

    public function getSequenceNumber(): SequenceNumber|null
    {
        return $this->sequenceNumber;
    }

    public function setSequenceNumber(SequenceNumber|null $sequenceNumber): EntryRelationship
    {
        $this->sequenceNumber = $sequenceNumber;
        return $this;
    }

    public function getAct(): Act
    {
        return $this->act;
    }

    public function setAct(Act $act): EntryRelationship
    {
        $this->act = $act;
        return $this;
    }

    public function getTypeCode()
    {
        return $this->typeCode;
    }

    public function setTypeCode(string $typeCode): EntryRelationship
    {
        $this->typeCode = $typeCode;
        return $this;
    }

    public function getInversionIndication(): ?bool
    {
        return $this->inversionIndication;
    }

    public function setInversionIndication(?bool $inversionIndication): EntryRelationship
    {
        $this->inversionIndication = $inversionIndication;
        return $this;
    }

    protected function getElementTag()
    {
        return 'entryRelationship';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        if ($this->inversionIndication !== null) {
            $el->setAttribute('inversionInd', $this->inversionIndication ? 'true' : 'false');
        }

        if ($this->sequenceNumber !== null) {
            $el->appendChild($this->sequenceNumber->toDOMElement($doc));
        }

        $el->appendChild($this->act->toDOMElement($doc));

        return $el;
    }
}