<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @implements NodeInterface<self>
 */
class Address implements NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected string $name;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME2')]
    protected string $name2;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME3')]
    protected string $name3;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DEPARTMENT')]
    protected string $department;

    #[Serializer\Expose]
    #[Serializer\Type(Details::class)]
    #[Serializer\SerializedName('CONTACT_DETAILS')]
    protected Details $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STREET')]
    protected string $street;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIP')]
    protected string $zip;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('BOXNO')]
    protected string $boxno;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIPBOX')]
    protected string $zipbox;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CITY')]
    protected string $city;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STATE')]
    protected string $state;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY')]
    protected string $country;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY_CODED')]
    protected string $countryCoded;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VAT_ID')]
    protected string $vatId;

    #[Serializer\Expose]
    #[Serializer\Type(Phone::class)]
    #[Serializer\SerializedName('PHONE')]
    protected Phone $phone;

    #[Serializer\Expose]
    #[Serializer\Type(Fax::class)]
    #[Serializer\SerializedName('FAX')]
    protected Fax $fax;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EMAIL')]
    protected string $email;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected PublicKey $publicKey;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('URL')]
    protected string $url;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ADDRESS_REMARKS')]
    protected string $addressRemarks;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName2(): string
    {
        return $this->name2;
    }

    public function setName2(string $name2): self
    {
        $this->name2 = $name2;
        return $this;
    }

    public function getName3(): string
    {
        return $this->name3;
    }

    public function setName3(string $name3): self
    {
        $this->name3 = $name3;
        return $this;
    }

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;
        return $this;
    }

    public function getContactDetails(): Contact\Details
    {
        return $this->contactDetails;
    }

    public function setContactDetails(Contact\Details $contactDetails): self
    {
        $this->contactDetails = $contactDetails;
        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;
        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;
        return $this;
    }

    public function getBoxno(): string
    {
        return $this->boxno;
    }

    public function setBoxno(string $boxno): self
    {
        $this->boxno = $boxno;
        return $this;
    }

    public function getZipbox(): string
    {
        return $this->zipbox;
    }

    public function setZipbox(string $zipbox): self
    {
        $this->zipbox = $zipbox;
        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;
        return $this;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getCountryCoded(): string
    {
        return $this->countryCoded;
    }

    public function setCountryCoded(string $countryCoded): self
    {
        $this->countryCoded = $countryCoded;
        return $this;
    }

    public function getVatId(): string
    {
        return $this->vatId;
    }

    public function setVatId(string $vatId): self
    {
        $this->vatId = $vatId;
        return $this;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getFax(): Fax
    {
        return $this->fax;
    }

    public function setFax(Fax $fax): self
    {
        $this->fax = $fax;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPublicKey(): Crypto\PublicKey
    {
        return $this->publicKey;
    }

    public function setPublicKey(Crypto\PublicKey $publicKey): self
    {
        $this->publicKey = $publicKey;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getAddressRemarks(): string
    {
        return $this->addressRemarks;
    }

    public function setAddressRemarks(string $addressRemarks): self
    {
        $this->addressRemarks = $addressRemarks;
        return $this;
    }
}
