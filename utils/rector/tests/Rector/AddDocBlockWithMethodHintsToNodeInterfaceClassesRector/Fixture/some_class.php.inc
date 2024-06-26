<?php

namespace Utils\Rector\Tests\Rector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRector\Fixture;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

class Address implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected ?string $name = null;

    /**
     * @var Details[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Details::class . '>')]
    #[Serializer\XmlList(entry: 'CONTACT_DETAILS', inline: true)]
    protected array $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected ?PublicKey $publicKey = null;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('NON_NULLABLE')]
    protected PublicKey $nonNullableTest;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\SerializedName('SOME_STRING_ARRAY')]
    protected array $someStringArray = [];
}
?>
-----
<?php

namespace Utils\Rector\Tests\Rector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRector\Fixture;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Contact\Details;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Crypto\PublicKey;

/**
 * @method self setName(string|null $name)
 * @method string|null getName()
 * @method self setContactDetails(\Naugrim\BMEcat\Nodes\Contact\Details[]|array $contactDetails)
 * @method \Naugrim\BMEcat\Nodes\Contact\Details[]|array getContactDetails()
 * @method self setPublicKey(null|array|\Naugrim\BMEcat\Nodes\Crypto\PublicKey $publicKey)
 * @method \Naugrim\BMEcat\Nodes\Crypto\PublicKey|null getPublicKey()
 * @method self setNonNullableTest(array|\Naugrim\BMEcat\Nodes\Crypto\PublicKey $nonNullableTest)
 * @method \Naugrim\BMEcat\Nodes\Crypto\PublicKey getNonNullableTest()
 * @method self setSomeStringArray(array $someStringArray)
 * @method string[] getSomeStringArray()
 */
class Address implements NodeInterface
{
    use HasSerializableAttributes;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('NAME')]
    protected ?string $name = null;

    /**
     * @var Details[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<' . Details::class . '>')]
    #[Serializer\XmlList(entry: 'CONTACT_DETAILS', inline: true)]
    protected array $contactDetails;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('PUBLIC_KEY')]
    protected ?PublicKey $publicKey = null;

    #[Serializer\Expose]
    #[Serializer\Type(PublicKey::class)]
    #[Serializer\SerializedName('NON_NULLABLE')]
    protected PublicKey $nonNullableTest;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\SerializedName('SOME_STRING_ARRAY')]
    protected array $someStringArray = [];
}
?>
