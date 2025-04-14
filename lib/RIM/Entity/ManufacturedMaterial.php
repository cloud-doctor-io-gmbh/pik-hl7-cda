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
namespace PHPHealth\CDA\RIM\Entity;

use PHPHealth\CDA\DataType\Code\CodedValue;
use PHPHealth\CDA\DataType\Collection\Set;
use PHPHealth\CDA\Elements\Code;
use PHPHealth\CDA\Pharm\ActiveIngredient;
use PHPHealth\CDA\Pharm\AsContent;

/**
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class ManufacturedMaterial extends DrugOrMaterial
{
    /**
     * @var CodedValue
     */
    protected $code;

    /**
     * @var AsContent
     */
    protected $asContent;

    /**
     * @var Set
     */
    protected $activeIngredients;
    
    public function __construct(CodedValue $code, AsContent $asContent)
    {
        $this->code = $code;
        $this->asContent = $asContent;
        $this->activeIngredients = new Set(ActiveIngredient::class);
    }
    
    public function getCode(): CodedValue
    {
        return $this->code;
    }

    public function setCode(CodedValue $code)
    {
        $this->code = $code;
        return $this;
    }

    public function getAsContent(): AsContent
    {
        return $this->asContent;
    }

    public function setAsContent(AsContent $asContent): ManufacturedMaterial
    {
        $this->asContent = $asContent;
        return $this;
    }

    public function getActiveIngredients(): Set
    {
        return $this->activeIngredients;
    }

    public function setActiveIngredients(Set $activeIngredients): ManufacturedMaterial
    {
        $this->activeIngredients = $activeIngredients;
        return $this;
    }

    protected function getElementTag(): string
    {
        return 'manufacturedMaterial';
    }

    public function getDefaultClassCode(): string
    {
        return 'MMAT';
    }

    public function toDOMElement(\DOMDocument $doc): \DOMElement
    {
        $el = $this->createElement($doc);

        $this->getTemplateIds()?->setValueToElement($el, $doc);
        $el->appendChild((new Code($this->getCode()))->toDOMElement($doc));
        $this->getNames()->setValueToElement($el, $doc);
        $el->appendChild($this->getAsContent()->toDOMElement($doc));
        $this->getActiveIngredients()->setValueToElement($el, $doc);
        
        return $el;
    }
}
