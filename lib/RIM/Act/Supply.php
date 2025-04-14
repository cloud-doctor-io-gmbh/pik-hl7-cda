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
namespace PHPHealth\CDA\RIM\Act;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\EntryRelationship;
use PHPHealth\CDA\Elements\IndependentInd;
use PHPHealth\CDA\Elements\Product;
use PHPHealth\CDA\Elements\Quantity;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\Elements\Text;
use PHPHealth\CDA\Elements\EffectiveTime;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;

/**
 * 
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class Supply extends Act
{
    /**
     * @var IndependentInd
     */
    private $independentInd;

    /**
     * @var Quantity
     */
    private $quantity;

    /**
     * @var Product
     */
    private $product;

    /**
     * @param EffectiveTime $effectiveTime
     * @param IndependentInd $independentInd
     * @param Quantity $quantity
     * @param Product $product
     */
    public function __construct(IndependentInd $independentInd, Quantity $quantity, Product $product)
    {
        $this->independentInd = $independentInd;
        $this->quantity = $quantity;
        $this->product = $product;
        $this->entryRelationships = new Set(EntryRelationship::class);
    }


    public function getClassCode(): string
    {
        return 'SPLY';
    }

    protected function getElementTag(): string
    {
        return 'supply';
    }
        
    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        
        if ($this->getTemplateIds() !== null) {
            foreach ($this->templateIds as $id) {
                $el->appendChild((new TemplateId($id))->toDOMElement($doc));
            }
        }
        
        if ($this->getIds() !== null) {
            foreach ($this->getIds()->getIterator() as $id) {
                /* @var $id InstanceIdentifier */
                $el->appendChild((new \PHPHealth\CDA\Elements\Id($id))
                    ->toDOMElement($doc));
            }
        }
        
        if ($this->getText() !== null) {
            $el->appendChild((new Text($this->getText()))->toDOMElement($doc));
        }
        
        if ($this->getStatusCode() !== null) {
            $el->appendChild($this->getStatusCode()->toDOMElement($doc));
        }
        
        $first = true;
        foreach ($this->getEffectiveTime() as $time) {
            $effectiveTime = new EffectiveTime($time);
            
            if (! $first) {
                $effectiveTime->setOperatorAppend();
            }
            
            $el->appendChild($effectiveTime
                ->toDOMElement($doc));
            
            $first = false;
        }

        if ($this->independentInd !== null) {
            $el->appendChild($this->independentInd->toDOMElement($doc));
        }

        if ($this->quantity !== null) {
            $el->appendChild($this->quantity->toDOMElement($doc));
        }

        if ($this->product !== null) {
            $el->appendChild($this->product->toDOMElement($doc));
        }

        $this->entryRelationships->setValueToElement($el, $doc);
        
        return $el;
    }

}
