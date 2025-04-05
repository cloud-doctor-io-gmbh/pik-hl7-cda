<?php

namespace PHPHealth\CDA\DataType\Address;

use PHPHealth\CDA\ClinicalDocument as CDA;
use PHPHealth\CDA\DataType\AnyType;
use PHPHealth\CDA\DataType\TextAndMultimedia\CharacterString;

/**
 * See: https://www.hl7.org/cda/stds/core/draft1/StructureDefinition-CR.html
 * NOTE: Many attributes have been left out, as we do not use them at the moment.
 *
 * @author Nick Djerfi <n.djerfi@cloud-doctor.io>
 */
class PostalAddress extends AnyType
{
    /**
     * @var CharacterString
     */
    private $country;

    /**
     * @var CharacterString
     */
    private $city;

    /**
     * @var CharacterString
     */
    private $postalCode;

    /**
     * @var CharacterString
     */
    private $houseNumber;

    /**
     * @var CharacterString
     */
    private $streetName;

    /**
     * @param CharacterString $country
     * @param CharacterString $city
     * @param CharacterString $postalCode
     * @param CharacterString $houseNumber
     * @param CharacterString $streetName
     */
    public function __construct(
        CharacterString $country = null,
        CharacterString $city = null,
        CharacterString $postalCode = null,
        CharacterString $houseNumber = null,
        CharacterString $streetName = null
    ) {
        $this->country = $country;
        $this->city = $city;
        $this->postalCode = $postalCode;
        $this->houseNumber = $houseNumber;
        $this->streetName = $streetName;
    }


    public function getCountry(): CharacterString
    {
        return $this->country;
    }

    public function setCountry(CharacterString $country): PostalAddress
    {
        $this->country = $country;
        return $this;
    }

    public function getCity(): CharacterString
    {
        return $this->city;
    }

    public function setCity(CharacterString $city): PostalAddress
    {
        $this->city = $city;
        return $this;
    }

    public function getPostalCode(): CharacterString
    {
        return $this->postalCode;
    }

    public function setPostalCode(CharacterString $postalCode): PostalAddress
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function getHouseNumber(): CharacterString
    {
        return $this->houseNumber;
    }

    public function setHouseNumber(CharacterString $houseNumber): PostalAddress
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    public function getStreetName(): CharacterString
    {
        return $this->streetName;
    }

    public function setStreetName(CharacterString $streetName): PostalAddress
    {
        $this->streetName = $streetName;
        return $this;
    }



    public function setValueToElement(\DOMElement &$el, \DOMDocument $doc = null)
    {
        if ($this->getCountry() !== null) {
            $subEl = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'country');
            $subEl->appendChild($doc->createTextNode($this->getCountry()->getContent()));
            $el->appendChild($subEl);
        }

        if ($this->getCity() !== null) {
            $subEl = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'city');
            $subEl->appendChild($doc->createTextNode($this->getCity()->getContent()));
            $el->appendChild($subEl);
        }

        if ($this->getPostalCode() !== null) {
            $subEl = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'postalCode');
            $subEl->appendChild($doc->createTextNode($this->getPostalCode()->getContent()));
            $el->appendChild($subEl);
        }

        if ($this->getHouseNumber() !== null) {
            $subEl = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'houseNumber');
            $subEl->appendChild($doc->createTextNode($this->getHouseNumber()->getContent()));
            $el->appendChild($subEl);
        }

        if ($this->getStreetName() !== null) {
            $subEl = $doc->createElementNS(CDA::NS_CDA_URI, CDA::NS_CDA.'streetName');
            $subEl->appendChild($doc->createTextNode($this->getStreetName()->getContent()));
            $el->appendChild($subEl);
        }
    }
}