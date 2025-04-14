<?php

namespace PHPHealth\CDA\Pharm;

use PHPHealth\CDA\DataType\TextAndMultimedia\CharacterString;

class Name extends AbstractPharmacyElement
{
    /**
     * @var CharacterString
     */
    private $content;

    public function __construct(CharacterString $content)
    {
        $this->setContent($content);
    }

    public function getContent(): CharacterString
    {
        return $this->content;
    }

    public function setContent(CharacterString $content)
    {
        $this->content = $content;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'name';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        $el->appendChild($doc->createTextNode($this->getContent()->getContent()));

        return $el;
    }
}