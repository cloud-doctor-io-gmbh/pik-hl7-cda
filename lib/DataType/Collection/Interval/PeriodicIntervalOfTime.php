<?php
/*
 * The MIT License
 *
 * Copyright 2017 Julien Fastré <julien.fastre@champs-libres.coop>.
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
namespace PHPHealth\CDA\DataType\Collection\Interval;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;

/**
 * 
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class PeriodicIntervalOfTime extends AbstractInterval
{
    /**
     * @var PhysicalQuantity|PhysicalQuantityInterval
     */
    protected $period;
    
    /**
     *
     * @var boolean
     */
    protected $institutionSpecified = null;
    
    public function __construct(PhysicalQuantity|PhysicalQuantityInterval $period)
    {
        $this->setPeriod($period);
    }
    
    public function getPeriod(): PhysicalQuantity|PhysicalQuantityInterval
    {
        return $this->period;
    }

    public function getInstitutionSpecified()
    {
        return $this->institutionSpecified;
    }

    public function setPeriod(PhysicalQuantity|PhysicalQuantityInterval $period)
    {
        $this->period = $period;
        
        return $this;
    }

    public function setInstitutionSpecified($institutionSpecified)
    {
        $this->institutionSpecified = $institutionSpecified;
        
        return $this;
    }
        
    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        if ($doc === null) {
            throw new \Exception("doc should not be null");
        }
        
        $el->setAttributeNS(CDA::NS_XSI_URI, 'xsi:type', 'PIVL_TS');
        
        if ($this->getInstitutionSpecified() !== null) {
            $el->setAttribute(CDA::NS_CDA.'institutionSpecified',
                $this->getInstitutionSpecified() ? 'true' : 'false');
        }

        $period = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'period');
        $this->getPeriod()->setValueToElement($period, $doc);
        
        $el->appendChild($period);
    }
}
