<?php
/*
 * The MIT License
 *
 * Copyright 2016 julien.
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
namespace PHPHealth\CDA\RIM\Entity;

use PHPHealth\CDA\Elements\Addr;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Code\CodedSimple;
use PHPHealth\CDA\Elements\Telecom;

/**
 * 
 *
 * @author julien
 */
abstract class Organization extends Entity
{
    /**
     *
     * @var CodedSimple
     */
    protected $classCode = 'ORG';

    /**
     * @var Set|null
     */
    protected $telecoms = null;

    /**
     * @var Set|null
     */
    protected $addrs = null;

    /**
     * @var AsOrganizationPartOf|null
     */
    protected $asOrganizationPartOf = null;
    
    public function __construct(
        Set|null $templateIds = null,
        Set|null $ids = null,
        Set|null $names = null,
        Set|null $telecoms = null,
        Set|null $addrs = null,
        AsOrganizationPartOf|null $asOrganizationPartOf = null
    )
    {
        $this->templateIds = $templateIds;
        $this->id = $ids;
        $this->names = $names;
        $this->telecoms = $telecoms;
        $this->addrs = $addrs;
        $this->asOrganizationPartOf = $asOrganizationPartOf;
    }

    public function getTelecoms(): Set|null
    {
        return $this->telecoms;
    }

    public function setTelecoms(Set $telecoms): Organization
    {
        $telecoms->checkContainsOrThrow(Telecom::class);
        $this->telecoms = $telecoms;
        return $this;
    }

    public function hasTelecoms(): bool
    {
        return $this->telecoms !== null;
    }

    public function getAddrs(): Set|null
    {
        return $this->addrs;
    }

    public function setAddrs(Set $addrs): Organization
    {
        $this->addrs->checkContainsOrThrow(Addr::class);
        $this->addrs->add($addrs);
        return $this;
    }

    public function hasAddrs(): bool
    {
        return $this->addrs !== null;
    }

    public function getAsOrganizationPartOf(): AsOrganizationPartOf|null
    {
        return $this->asOrganizationPartOf;
    }

    public function setAsOrganizationPartOf(AsOrganizationPartOf $asOrganizationPartOf): Organization
    {
        $this->asOrganizationPartOf = $asOrganizationPartOf;
        return $this;
    }

    public function hasAsOrganizationPartOf(): bool
    {
        return $this->asOrganizationPartOf !== null;
    }

    public function getDefaultClassCode()
    {
        return $this->classCode;
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        if ($this->hasTemplateIds()) {
            $this->getTemplateIds()->setValueToElement($el, $doc);
        }

        if ($this->hasIds()) {
            foreach ($this->getId() as $idValue) {
                $idElement = new Id($idValue);
                $el->appendChild($idElement->toDomElement($doc));
            }
        }

        if ($this->hasNames()) {
            foreach ($this->getNames()->get() as $name) {
                /* @var $name \PHPHealth\CDA\DataType\Name\EntityName */
                $name->setValueToElement($el, $doc);
            }
        }

        if ($this->hasTelecoms()) {
            $this->telecoms->setValueToElement($el, $doc);
        }

        if ($this->hasAddrs()) {
            $this->addrs->setValueToElement($el, $doc);
        }

        if ($this->hasAsOrganizationPartOf()) {
            $el->appendChild($this->getAsOrganizationPartOf()->toDOMElement($doc));
        }
        
        return $el;
    }
}
