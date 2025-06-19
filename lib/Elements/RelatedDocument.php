<?php

namespace PHPHealth\CDA\Elements;

use PHPHealth\CDA\HasTypeCode;

class RelatedDocument extends AbstractElement implements HasTypeCode
{
    /**
     * @var array
     */
    protected $templateIds = [];

    /**
     * @var ParentDocument
     */
    protected $parentDocument;

    /**
     * @param array $templateIds
     * @param ParentDocument $parentDocument
     */
    public function __construct(ParentDocument $parentDocument)
    {
        $this->parentDocument = $parentDocument;
    }

    public function getTemplateIds(): array
    {
        return $this->templateIds;
    }

    public function setTemplateIds(array $templateIds): RelatedDocument
    {
        $this->templateIds = $templateIds;
        return $this;
    }

    public function getParentDocument(): ParentDocument
    {
        return $this->parentDocument;
    }

    public function setParentDocument(ParentDocument $parentDocument): RelatedDocument
    {
        $this->parentDocument = $parentDocument;
        return $this;
    }

    protected function getElementTag()
    {
        return "relatedDocument";
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        foreach ($this->templateIds as $templateId) {
            $el->appendChild($templateId->toDOMElement($doc));
        }

        $el->appendChild($this->parentDocument->toDOMElement($doc));

        return $el;
    }

    public function getTypeCode()
    {
        return "RPLC";
    }
}