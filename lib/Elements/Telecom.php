<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Address\TelecommunicationAddress;

class Telecom extends AbstractElement
{
    /**
     * @var TelecommunicationAddress
     */
    protected $telecom;

    public function __construct(TelecommunicationAddress $telecom)
    {
        $this->setTelecom($telecom);
    }

    public function getTelecom(): TelecommunicationAddress
    {
        return $this->telecom;
    }

    public function setTelecom(TelecommunicationAddress $telecom): Telecom
    {
        $this->telecom = $telecom;
        return $this;
    }

    protected function getElementTag()
    {
        return 'telecom';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('telecom'));
    }
}