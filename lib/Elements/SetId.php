<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class SetId extends AbstractElement
{
    /**
     *
     * @var InstanceIdentifier
     */
    protected $identifier;


    public function __construct(InstanceIdentifier $identifier)
    {
        $this->setIdentifier($identifier);
    }


    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setIdentifier(InstanceIdentifier $identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    protected function getElementTag()
    {
        return 'setId';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array('identifier'));
    }
}