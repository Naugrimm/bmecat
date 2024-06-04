<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface<Address>
 * @method self setName(string|null $name)
 * @method string|null getName()
 * @method self setName2(string|null $name2)
 * @method string|null getName2()
 * @method self setName3(string|null $name3)
 * @method string|null getName3()
 * @method self setDepartment(string|null $department)
 * @method string|null getDepartment()
 * @method self setContactDetails(\Naugrim\BMEcat\Nodes\Contact\Details[]|array $contactDetails)
 * @method \Naugrim\BMEcat\Nodes\Contact\Details[]|array getContactDetails()
 * @method self setStreet(string|null $street)
 * @method string|null getStreet()
 * @method self setZip(string|null $zip)
 * @method string|null getZip()
 * @method self setBoxno(string|null $boxno)
 * @method string|null getBoxno()
 * @method self setZipbox(string|null $zipbox)
 * @method string|null getZipbox()
 * @method self setCity(string|null $city)
 * @method string|null getCity()
 * @method self setState(string|null $state)
 * @method string|null getState()
 * @method self setCountry(string|null $country)
 * @method string|null getCountry()
 * @method self setCountryCoded(string|null $countryCoded)
 * @method string|null getCountryCoded()
 * @method self setVatId(string|null $vatId)
 * @method string|null getVatId()
 * @method self setPhone(null|array|\Naugrim\BMEcat\Nodes\Phone $phone)
 * @method \Naugrim\BMEcat\Nodes\Phone|null getPhone()
 * @method self setFax(null|array|\Naugrim\BMEcat\Nodes\Fax $fax)
 * @method \Naugrim\BMEcat\Nodes\Fax|null getFax()
 * @method self setEmail(string|null $email)
 * @method string|null getEmail()
 * @method self setPublicKey(null|array|\Naugrim\BMEcat\Nodes\Crypto\PublicKey $publicKey)
 * @method \Naugrim\BMEcat\Nodes\Crypto\PublicKey|null getPublicKey()
 * @method self setUrl(string|null $url)
 * @method string|null getUrl()
 * @method self setAddressRemarks(string|null $addressRemarks)
 * @method string|null getAddressRemarks()
 */
class Address implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected ?string $name = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME2')]
    protected ?string $name2 = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME3')]
    protected ?string $name3 = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DEPARTMENT')]
    protected ?string $department = null;

    /**
     * @var Details[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Details::class . '>')]
    #[Serializer\XmlList(entry: 'CONTACT_DETAILS', inline: true)]
    protected array $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STREET')]
    protected ?string $street = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIP')]
    protected ?string $zip = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('BOXNO')]
    protected ?string $boxno = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ZIPBOX')]
    protected ?string $zipbox = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CITY')]
    protected ?string $city = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('STATE')]
    protected ?string $state = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY')]
    protected ?string $country = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('COUNTRY_CODED')]
    protected ?string $countryCoded = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('VAT_ID')]
    protected ?string $vatId = null;

    #[Serializer\Expose]
    #[Serializer\Type(Phone::class)]
    #[Serializer\SerializedName('PHONE')]
    protected ?Phone $phone = null;

    #[Serializer\Expose]
    #[Serializer\Type(Fax::class)]
    #[Serializer\SerializedName('FAX')]
    protected ?Fax $fax = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('EMAIL')]
    protected ?string $email = null;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected ?PublicKey $publicKey = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('URL')]
    protected ?string $url = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ADDRESS_REMARKS')]
    protected ?string $addressRemarks = null;
}
