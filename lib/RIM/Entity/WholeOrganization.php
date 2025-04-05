<?php

namespace PHPHealth\CDA\RIM\Entity;

/**
 * See: https://www.hl7.org/cda/stds/core/draft1/StructureDefinition-OrganizationPartOf.html
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class WholeOrganization extends Organization
{

    protected function getElementTag()
    {
        return 'wholeOrganization';
    }
}