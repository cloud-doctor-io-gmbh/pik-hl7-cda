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
namespace PHPHealth\CDA\RIM\Role;

use PHPHealth\CDA\ClinicalDocument;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\ExtPL\BoundedBy;
use PHPHealth\CDA\RIM\Entity\Person;
use PHPHealth\CDA\DataType\Code\CodedWithEquivalents;
use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\Elements\Id;
use PHPHealth\CDA\RIM\Entity\RepresentedOrganization;
use PHPHealth\CDA\RIM\Participation\Author;

/**
 * 
 *
 * @author julien
 */
class AssignedAuthor extends Role
{
    /**
     *
     * @var Set
     */
    protected $ids;
    
    /**
     *
     * @var CodedWithEquivalents
     */
    protected $code;
    
    /**
     *
     * @var Set
     */
    protected $addrs;
    
    /**
     *
     * @var Set
     */
    protected $telecoms;
    
    /**
     *
     * @var Person
     */
    protected $author;

    /**
     * @var RepresentedOrganization
     */
    protected $representedOrganization;

    /**
     * @var ?BoundedBy
     */
    private $boundedBy = null;

    /**
     * @var ?string
     */
    private $xsiType = null;
    
    /**
     * 
     * @param Person $author
     * @param Set $ids
     * @param CodedWithEquivalents $code
     * @param Set $addrs
     * @param Set $telecoms
     * @param RepresentedOrganization $representedOrganization
     */
    public function __construct(
        Person $author, 
        Set $ids,
        CodedWithEquivalents $code = null,
        Set $addrs = null,
        Set $telecoms = null,
        RepresentedOrganization $representedOrganization = null
    ) {
        $this->setAuthor($author);
        $this->setIds($ids);
        
        if (null !== $code) {
            $this->setCode($code);
        }
        
        if (null !== $addrs) {
            $this->setAddrs($addrs);
        }
        
        if (null !== $telecoms) {
            $this->setTelecoms($telecoms);
        }

        if ($representedOrganization !== null) {
            $this->setRepresentedOrganization($representedOrganization);
        }
    }
    
    
    public function getIds(): Set
    {
        return $this->ids;
    }

    public function getCode(): CodedWithEquivalents
    {
        return $this->code;
    }

    public function getAddrs(): Set
    {
        return $this->addrs;
    }

    public function getTelecoms(): Set
    {
        return $this->telecoms;
    }

    public function getAuthor(): Person
    {
        return $this->author;
    }

    public function getRepresentedOrganization(): RepresentedOrganization
    {
        return $this->representedOrganization;
    }

    public function setIds(Set $ids)
    {
        $ids->checkContainsOrThrow(InstanceIdentifier::class);
        
        $this->ids = $ids;
        
        return $this;
    }

    public function setCode(CodedWithEquivalents $code)
    {
        $this->code = $code;
        return $this;
    }

    public function setAddrs(Set $addrs)
    {
        $this->addrs = $addrs;
        return $this;
    }

    public function setTelecoms(Set $telecoms)
    {
        $this->telecoms = $telecoms;
        return $this;
    }

    public function setAuthor(Person $author)
    {
        $this->author = $author;
        return $this;
    }

    public function setRepresentedOrganization(RepresentedOrganization $representedOrganization): AssignedAuthor
    {
        $this->representedOrganization = $representedOrganization;
        return $this;
    }

    public function hasRepresentedOrganization(): bool
    {
        return $this->representedOrganization !== null;
    }

    public function getBoundedBy(): ?BoundedBy
    {
        return $this->boundedBy;
    }

    public function setBoundedBy(?BoundedBy $boundedBy): AssignedAuthor
    {
        $this->boundedBy = $boundedBy;
        return $this;
    }

    public function getXsiType(): ?string
    {
        return $this->xsiType;
    }

    public function setXsiType(?string $xsiType): AssignedAuthor
    {
        $this->xsiType = $xsiType;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'assignedAuthor';
    }
    
    public function getClassCode()
    {
        return 'ASSIGNED';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);
        
        foreach ($this->ids->get() as $ii) {
            $el->appendChild((new Id($ii))->toDOMElement($doc));
        }
        
        $el->appendChild($this->author->toDOMElement($doc));

        if ($this->hasRepresentedOrganization()) {
            $el->appendChild($this->representedOrganization->toDOMElement($doc));
        }

        if ($this->getBoundedBy() !== null) {
            $el->appendChild($this->getBoundedBy()->toDOMElement($doc));
        }

        if ($this->getXsiType() !== null) {
            $el->setAttributeNS(ClinicalDocument::NS_XSI_URI, 'xsi:type', $this->getXsiType());
        }
        
        return $el;
    }
}
