<?php

namespace PHPHealth\CDA\ExtPL;

use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\AbstractElement;
use PHPHealth\CDA\Elements\TemplateId;
use PHPHealth\CDA\HasTypeCode;

class BoundedBy extends AbstractExtPLElement implements HasTypeCode
{
    /**
     * @var Set
     */
    protected $templateIds;

    /**
     * @var ReimbursementRelatedContract
     */
    protected $reimbursementRelatedContract;

    public function __construct(ReimbursementRelatedContract $reimbursementRelatedContract)
    {
        $this->templateIds = new Set(TemplateId::class);
        $this->reimbursementRelatedContract = $reimbursementRelatedContract;
    }

    public function getTemplateIds(): Set
    {
        return $this->templateIds;
    }

    public function setTemplateIds(Set $templateIds): BoundedBy
    {
        $this->templateIds = $templateIds;
        return $this;
    }

    public function addTemplateId(TemplateId $templateId): BoundedBy
    {
        $this->templateIds->add($templateId);
        return $this;
    }

    public function getReimbursementRelatedContract(): ReimbursementRelatedContract
    {
        return $this->reimbursementRelatedContract;
    }

    public function setReimbursementRelatedContract(ReimbursementRelatedContract $reimbursementRelatedContract): BoundedBy
    {
        $this->reimbursementRelatedContract = $reimbursementRelatedContract;
        return $this;
    }

    protected function getElementTag()
    {
        return 'boundedBy';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        $this->templateIds->setValueToElement($el);
        $el->appendChild($this->reimbursementRelatedContract->toDOMElement($doc));

        return $el;
    }

    public function getTypeCode()
    {
        return 'PART';
    }
}