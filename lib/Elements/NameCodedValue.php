<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\CodedValue;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class NameCodedValue extends AbstractElement
{
    /**
     *
     * @var CodedValue
     */
    protected $name;

    public function __construct(CodedValue $name)
    {
        $this->setName($name);
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('name'));
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(CodedValue $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getElementTag()
    {
        return "name";
    }
}