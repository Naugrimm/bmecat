<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setName(string $name)
 * @method string getName()
 * @method self setValue(string $value)
 * @method string getValue()
 * @method self setUnit(string|null $unit)
 * @method string|null getUnit()
 * @method self setOrder(int|null $order)
 * @method int|null getOrder()
 * @method self setDescription(string|null $description)
 * @method string|null getDescription()
 * @method self setValueDetails(string|null $valueDetails)
 * @method string|null getValueDetails()
 */
#[Serializer\XmlRoot('FEATURE')]
class Feature implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FNAME')]
    protected string $name;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'FVALUE', inline: true)]
    protected array $value = [];

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FUNIT')]
    protected ?string $unit = null;

    #[Serializer\Expose]
    #[Serializer\Type('int')]
    #[Serializer\SerializedName('FORDER')]
    protected ?int $order = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FDESCR')]
    protected ?string $description = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FVALUE_DETAILS')]
    protected ?string $valueDetails = null;
}
