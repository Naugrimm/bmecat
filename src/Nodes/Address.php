<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @implements \Naugrim\BMEcat\Nodes\Contracts\NodeInterface<Address>
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
