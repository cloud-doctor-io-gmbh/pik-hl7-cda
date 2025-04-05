<?php

namespace PHPHealth\CDA\RIM\Entity;

/**
 * See: https://www.hl7.org/cda/stds/core/draft1/StructureDefinition-Organization.html
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class AsOrganizationPartOf extends OrganizationPartOf
{

    protected function getElementTag()
    {
        return 'asOrganizationPartOf';
    }
}