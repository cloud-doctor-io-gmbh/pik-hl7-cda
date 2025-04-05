<?php

namespace PHPHealth\CDA\RIM\Entity;

/**
 * See: https://www.hl7.org/cda/stds/core/draft1/StructureDefinition-OrganizationPartOf.html
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
abstract class OrganizationPartOf extends Entity
{
    /**
     * @var Organization
     */
    protected $wholeOrganization;

    public function __construct(Organization $wholeOrganization = null)
    {
        $this->wholeOrganization = $wholeOrganization;
    }

    public function getWholeOrganization(): Organization
    {
        return $this->wholeOrganization;
    }

    public function setWholeOrganization(Organization $wholeOrganization): OrganizationPartOf
    {
        $this->wholeOrganization = $wholeOrganization;
        return $this;
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);
        $el->appendChild($this->wholeOrganization->toDOMElement($doc));
        return $el;
    }

    public function getDefaultClassCode()
    {
        return 'PART';
    }
}