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

use PHPHealth\CDA\DataType\Identifier\InstanceIdentifier;
use PHPHealth\CDA\HasClassCode;
use PHPHealth\CDA\HasMoodCodeInterface;

/**
 *
 *
 * @author Julien Fastré <julien.fastre@champs-libres.coop>
 */
class ExternalDocument extends AbstractElement implements HasClassCode, HasMoodCodeInterface
{
    /**
     *
     * @var array
     */
    protected $templateIds;

    /**
     * @var RawText
     */
    protected $text;

    /**
     * @var string
     */
    protected $moodCode;

    public function getTemplateIds()
    {
        return $this->templateIds;
    }

    /**
     *
     * @param InstanceIdentifier[] $templateIds
     * @return $this
     */
    public function setTemplateIds(array $templateIds)
    {
        // check that each element is an instance of InstanceIdentifier
        $result = \array_reduce($templateIds, function ($carry, $current) {
            if ($carry === false) {
                return false;
            }

            return $current instanceof InstanceIdentifier;
        });

        if ($result === false) {
            throw new \RuntimeException(sprintf("the templateIds must be "
                . "instance of %s", InstanceIdentifier::class));
        }

        $this->templateIds = $templateIds;


        return $this;
    }

    public function addTemplateId(InstanceIdentifier $id)
    {
        $this->templateIds[] = $id;

        return $this;
    }

    public function getText(): RawText
    {
        return $this->text;
    }

    public function setText(RawText $text): ExternalDocument
    {
        $this->text = $text;
        return $this;
    }

    protected function getElementTag()
    {
        return 'externalDocument';
    }

    public function toDOMElement(\DOMDocument $doc)
    {
        $el = $this->createElement($doc);

        if ($this->getTemplateIds() !== null) {
            foreach ($this->templateIds as $id) {
                $el->appendChild((new TemplateId($id))->toDOMElement($doc));
            }
        }

        $el->appendChild($this->text->toDOMElement($doc));

        return $el;
    }

    public function getClassCode(): string
    {
        return 'DOC';
    }

    public function getMoodCode()
    {
        return $this->moodCode;
    }

    public function setMoodCode(string $moodCode): ExternalDocument
    {
        $this->moodCode = $moodCode;
        return $this;
    }
}
