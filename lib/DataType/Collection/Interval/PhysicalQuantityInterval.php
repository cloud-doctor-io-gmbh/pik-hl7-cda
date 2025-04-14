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
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;


/**
 * 
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class PhysicalQuantityInterval extends AbstractInterval
{
    /**
     *
     * @var PhysicalQuantity|null
     */
    private $low;
    
    /**
     *
     * @var PhysicalQuantity|null
     */
    private $high;
    
    function __construct(PhysicalQuantity|null $low = null, PhysicalQuantity|null $high = null)
    {
        $this->setHigh($high);
        $this->setLow($low);
    }

    
    function getLow(): PhysicalQuantity
    {
        return $this->low;
    }

    function getHigh(): PhysicalQuantity
    {
        return $this->high;
    }

    function setLow(PhysicalQuantity|null $low)
    {
        $this->low = $low;
        return $this;
    }

    function setHigh(PhysicalQuantity|null $high)
    {
        $this->high = $high;
        return $this;
    }

        
    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        $low = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'low');
        if ($this->low !== null) {
            $this->low->setValueToElement($low, $doc);
        } else {
            $low->setAttribute('nullFlavor', 'NA');
        }
        
        $high = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'high');
        if ($this->high !== null) {
            $this->high->setValueToElement($high, $doc);
        } else {
            $high->setAttribute('nullFlavor', 'NA');
        }
        
        $el->appendChild($low);
        $el->appendChild($high);
        $el->setAttributeNS(CDA::NS_XSI_URI, 'xsi:type', 'IVL_PQ');
    }
}
