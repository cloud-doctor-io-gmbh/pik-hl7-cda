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

namespace PHPHealth\CDA\RIM\Role;

use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\Addr;
use PHPHealth\CDA\Elements\Telecom;
use PHPHealth\CDA\RIM\Entity\Patient;
use PHPHealth\CDA\ClinicalDocument as CDA;

/**
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class PatientRole extends Role
{
    /**
     *
     * @var Set
     */
    protected $patientIds;

    /**
     * @var Set|null
     */
    protected $addr;

    /**
     * @var Set|null
     */
    protected $telecom;
    
    /**
     *
     * @var Patient|null
     */
    protected $patient;
    
    public function __construct(
        Set $ids,
        Set|null $addr = null,
        Set|null $telecom = null,
        Patient|null $patient = null
    ) {
        $this->setPatientIds($ids);
        $this->setPatient($patient);
    }
    
    /**
     *
     * @return Set
     */
    public function getPatientIds()
    {
        return $this->patientIds;
    }

    /**
     *
     * @param Set $patientIds
     * @return $this
     */
    public function setPatientIds(Set $patientIds)
    {
        if ($patientIds->getElementName() !== InstanceIdentifier::class) {
            throw new \UnexpectedValueException("The values of patientsIds shoud"
                    . " be instances of ".InstanceIdentifier::class.", "
                    . "".$patientIds->getElementName()." given");
        }
        
        $this->patientIds = $patientIds;
        
        return $this;
    }
    
    public function addPatientId(InstanceIdentifier $ii)
    {
        $this->patientIds[] = $ii;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function setPatient(Patient|null $patient)
    {
        $this->patient = $patient;
        return $this;
    }

    public function getAddr(): ?Set
    {
        return $this->addr;
    }

    public function setAddr(Set $addr): PatientRole
    {
        $addr->checkContainsOrThrow(Addr::class);
        $this->addr = $addr;
        return $this;
    }

    public function getTelecom(): ?Set
    {
        return $this->telecom;
    }

    public function setTelecom(Set $telecom): PatientRole
    {
        $telecom->checkContainsOrThrow(Telecom::class);
        $this->telecom = $telecom;
        return $this;
    }

            
    protected function getElementTag()
    {
        return 'patientRole';
    }
    
    public function getClassCode()
    {
        return 'PAT';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);
        
        foreach ($this->patientIds->get() as $ii) {
            $id = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'id');
            $ii->setValueToElement($id, $doc);
            $el->appendChild($id);
        }

        $this->getAddr()?->setValueToElement($el, $doc);
        $this->getTelecom()?->setValueToElement($el, $doc);

        if ($this->getPatient() !== null) {
            $el->appendChild($this->getPatient()->toDOMElement($doc));
        }
        
        return $el;
    }
}
