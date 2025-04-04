<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\ConceptDescriptor;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class Translation extends AbstractElement
{
    /**
     *
     * @var ConceptDescriptor
     */
    protected $conceptDescriptor;

    public function __construct(ConceptDescriptor $conceptDescriptor)
    {
        $this->setConceptDescriptor($conceptDescriptor);
    }

    public function getConceptDescriptor()
    {
        return $this->conceptDescriptor;
    }

    public function setConceptDescriptor(ConceptDescriptor $conceptDescriptor)
    {
        $this->conceptDescriptor = $conceptDescriptor;
    }

    protected function getElementTag()
    {
        return 'translation';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('conceptDescriptor'));
    }
}