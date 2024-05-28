<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

class Address implements NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected string $name;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME2')]
    protected string $name2;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME3')]
    protected string $name3;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DEPARTMENT')]
    protected string $department;

    /**
     *
     * @var Details
     */
    #[Serializer\Expose]
    #[Serializer\Type(Details::class)]
    #[Serializer\SerializedName('CONTACT_DETAILS')]
    protected Details $contactDetails;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STREET')]
    protected string $street;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIP')]
    protected string $zip;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('BOXNO')]
    protected string $boxno;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIPBOX')]
    protected string $zipbox;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CITY')]
    protected string $city;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STATE')]
    protected string $state;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY')]
    protected string $country;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY_CODED')]
    protected string $countryCoded;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VAT_ID')]
    protected string $vatId;

    /**
     *
     * @var Phone
     */
    #[Serializer\Expose]
    #[Serializer\Type(Phone::class)]
    #[Serializer\SerializedName('PHONE')]
    protected Phone $phone;

    /**
     *
     * @var Fax
     */
    #[Serializer\Expose]
    #[Serializer\Type(Fax::class)]
    #[Serializer\SerializedName('FAX')]
    protected Fax $fax;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EMAIL')]
    protected string $email;

    /**
     *
     * @var PublicKey
     */
    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected PublicKey $publicKey;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('URL')]
    protected string $url;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ADDRESS_REMARKS')]
    protected string $addressRemarks;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Address
     */
    public function setName(string $name): Address
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName2(): string
    {
        return $this->name2;
    }

    /**
     * @param string $name2
     * @return Address
     */
    public function setName2(string $name2): Address
    {
        $this->name2 = $name2;
        return $this;
    }

    /**
     * @return string
     */
    public function getName3(): string
    {
        return $this->name3;
    }

    /**
     * @param string $name3
     * @return Address
     */
    public function setName3(string $name3): Address
    {
        $this->name3 = $name3;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     * @return Address
     */
    public function setDepartment(string $department): Address
    {
        $this->department = $department;
        return $this;
    }

    /**
     * @return Contact\Details
     */
    public function getContactDetails(): Contact\Details
    {
        return $this->contactDetails;
    }

    /**
     * @param Contact\Details $contactDetails
     * @return Address
     */
    public function setContactDetails(Contact\Details $contactDetails): Address
    {
        $this->contactDetails = $contactDetails;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Address
     */
    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getZip(): string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return Address
     */
    public function setZip(string $zip): Address
    {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return string
     */
    public function getBoxno(): string
    {
        return $this->boxno;
    }

    /**
     * @param string $boxno
     * @return Address
     */
    public function setBoxno(string $boxno): Address
    {
        $this->boxno = $boxno;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipbox(): string
    {
        return $this->zipbox;
    }

    /**
     * @param string $zipbox
     * @return Address
     */
    public function setZipbox(string $zipbox): Address
    {
        $this->zipbox = $zipbox;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Address
     */
    public function setState(string $state): Address
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCoded(): string
    {
        return $this->countryCoded;
    }

    /**
     * @param string $countryCoded
     * @return Address
     */
    public function setCountryCoded(string $countryCoded): Address
    {
        $this->countryCoded = $countryCoded;
        return $this;
    }

    /**
     * @return string
     */
    public function getVatId(): string
    {
        return $this->vatId;
    }

    /**
     * @param string $vatId
     * @return Address
     */
    public function setVatId(string $vatId): Address
    {
        $this->vatId = $vatId;
        return $this;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     * @return Address
     */
    public function setPhone(Phone $phone): Address
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return Fax
     */
    public function getFax(): Fax
    {
        return $this->fax;
    }

    /**
     * @param Fax $fax
     * @return Address
     */
    public function setFax(Fax $fax): Address
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Address
     */
    public function setEmail(string $email): Address
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return Crypto\PublicKey
     */
    public function getPublicKey(): Crypto\PublicKey
    {
        return $this->publicKey;
    }

    /**
     * @param Crypto\PublicKey $publicKey
     * @return Address
     */
    public function setPublicKey(Crypto\PublicKey $publicKey): Address
    {
        $this->publicKey = $publicKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Address
     */
    public function setUrl(string $url): Address
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddressRemarks(): string
    {
        return $this->addressRemarks;
    }

    /**
     * @param string $addressRemarks
     * @return Address
     */
    public function setAddressRemarks(string $addressRemarks): Address
    {
        $this->addressRemarks = $addressRemarks;
        return $this;
    }
}
