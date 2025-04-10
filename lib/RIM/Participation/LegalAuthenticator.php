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
namespace PHPHealth\CDA\RIM\Participation;

use PHPHealth\CDA\DataType\Code\CodedSimple;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\DataType\Quantity\DateAndTime\TimeStamp;
use PHPHealth\CDA\Elements\SignatureCode;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\Elements\Time;
use PHPHealth\CDA\RIM\Role\AssignedEntity;

/**
 * 
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class LegalAuthenticator extends Participation
{
    /**
     *
     * @var AssignedEntity
     */
    protected $assignedEntity;

    /**
     * @var Time
     */
    protected $time;

    /**
     * @var SignatureCode
     */
    protected $signatureCode;

    /**
     * @var Set|null
     */
    protected $templateIds;
    
    public function __construct(
        AssignedEntity $assignedEntity,
        Time $time,
        SignatureCode $signatureCode,
        Set|null $templateIds = null
    ) {
        $this->setAssignedEntity($assignedEntity);
        $this->setTime($time);
        $this->setSignatureCode($signatureCode);
        $this->setTemplateIds($templateIds);
    }
    
    /**
     * 
     * @return AssignedEntity
     */
    public function getAssignedEntity(): AssignedEntity
    {
        return $this->assignedEntity;
    }

    /**
     * 
     * @param AssignedEntity $assignedEntity
     * @return $this
     */
    public function setAssignedEntity(AssignedEntity $assignedEntity)
    {
        $this->assignedEntity = $assignedEntity;
        
        return $this;
    }

    public function getSignatureCode(): SignatureCode
    {
        return $this->signatureCode;
    }

    public function setSignatureCode(SignatureCode $signatureCode): LegalAuthenticator
    {
        $this->signatureCode = $signatureCode;
        return $this;
    }

    public function getTime(): Time
    {
        return $this->time;
    }

    public function setTime(Time $time): LegalAuthenticator
    {
        $this->time = $time;
        return $this;
    }

    public function getTemplateIds(): Set|null
    {
        return $this->templateIds;
    }

    public function setTemplateIds(Set|null $templateIds): LegalAuthenticator
    {
        $templateIds?->checkContainsOrThrow(TemplateId::class);
        $this->templateIds = $templateIds;
        return $this;
    }
        
    protected function getElementTag(): string
    {
        return 'legalAuthenticator';
    }
    
    public function getTypeCode()
    {
        return 'LA';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        $this->getTemplateIds()?->setValueToElement($el, $doc);
        $el->appendChild($this->getTime()->toDOMElement($doc));
        $el->appendChild($this->getSignatureCode()->toDOMElement($doc));
        $el->appendChild($this->getAssignedEntity()->toDOMElement($doc));
        
        return $el;
    }
}
