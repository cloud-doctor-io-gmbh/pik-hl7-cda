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

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\DataType\Collection\Interval\PhysicalQuantityInterval;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\DataType\Collection\Interval\PeriodicIntervalOfTime;
use PHPHealth\CDA\DataType\Collection\Interval\IntervalOfTime;
use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\Quantity\PhysicalQuantity\PhysicalQuantity;

/**
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class EffectiveTime extends AbstractElement
{
    /**
     *
     * @var TimeStamp|PeriodicIntervalOfTime|PhysicalQuantityInterval|PhysicalQuantity
     */
    protected $value;
    
    /**
     *
     * @var string
     */
    protected $operator = '';
    
    public function __construct($value)
    {
        $this->setValue($value);
    }
    
    
    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        if ($value instanceof PeriodicIntervalOfTime 
            ||
            $value instanceof TimeStamp
            ||
            $value instanceof IntervalOfTime
            ||
            $value instanceof PhysicalQuantityInterval
            ||
            $value instanceof PhysicalQuantity
            ) {
            $this->value = $value;
        } else {
            throw new \UnexpectedValueException(sprintf("The timestamp must "
                . "implements %s, %s, %s, %s, or %s", PeriodicIntervalOfTime::class,
                TimeStamp::class, IntervalOfTime::class, PhysicalQuantityInterval::class, PhysicalQuantity::class));
        }
        
        return $this;
    }
    
    public function setOperatorAppend(): EffectiveTime
    {
        $this->operator = 'A';
        return $this;
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc, ['value']);
        
        if ($this->operator === 'A') {
            $el->setAttribute(CDA::NS_CDA.'operator', 'A');
        }
        
        return $el;
    }

    protected function getElementTag()
    {
        return 'effectiveTime';
    }
}
