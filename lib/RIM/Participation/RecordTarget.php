<?php

/*
 * The MIT License
 *
 * Copyright 2016 Julien Fastré <julien.fastre@champs-libres.coop>.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace PHPHealth\CDA\RIM\Participation;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\RIM\Role\PatientRole;

/**
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class RecordTarget extends Participation
{
    /**
     * @var Set|null
     */
    protected $templateIds;

    /**
     *
     * @var PatientRole
     */
    protected $patientRole;
    
    public function __construct(
        PatientRole $patientRole,
        Set|null $templateIds = null,
    ) {
        $this->setPatientRole($patientRole);
        $this->setTemplateIds($templateIds);
    }

    public function getTemplateIds(): Set|null
    {
        return $this->templateIds;
    }

    public function setTemplateIds(Set $templateIds): RecordTarget
    {
        $templateIds->checkContainsOrThrow(TemplateId::class);
        $this->templateIds = $templateIds;
        return $this;
    }
    
    public function getPatientRole()
    {
        return $this->patientRole;
    }

    public function setPatientRole(PatientRole $patientRole)
    {
        $this->patientRole = $patientRole;
        return $this;
    }

        
    protected function getElementTag()
    {
        return 'recordTarget';
    }
    
    public function getTypeCode()
    {
        return 'RCT';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $this->getTemplateIds()?->setValueToElement($el, $doc);
        
        $el->appendChild($this->patientRole->toDOMElement($doc));
        
        return $el;
    }
}
