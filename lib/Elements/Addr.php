<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Address\PostalAddress;

class Addr extends AbstractElement
{
    /**
     * @var PostalAddress
     */
    protected $addr;

    public function __construct(PostalAddress $addr)
    {
        $this->setAddr($addr);
    }

    public function getAddr(): PostalAddress
    {
        return $this->addr;
    }

    public function setAddr(PostalAddress $addr): Addr
    {
        $this->addr = $addr;
        return $this;
    }

    protected function getElementTag()
    {
        return 'addr';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('addr'));
    }
}