<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Code\ConceptRole;

/**
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class Qualifier extends AbstractElement
{
    /**
     *
     * @var ConceptRole
     */
    protected $conceptRole;

    public function __construct(ConceptRole $conceptRole)
    {
        $this->setConceptRole($conceptRole);
    }

    public function getConceptRole(): ConceptRole
    {
        return $this->conceptRole;
    }

    public function setConceptRole(ConceptRole $conceptRole)
    {
        $this->conceptRole = $conceptRole;
    }

    protected function getElementTag()
    {
        return 'qualifier';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        return $this->createElement($doc, array ('conceptRole'));
    }
}