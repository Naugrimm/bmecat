<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setAlternatives(\Naugrim\BMEcat\Nodes\Product\Config\PartAlternative|array $alternatives)
 * @method Naugrim\BMEcat\Nodes\Product\Config\PartAlternative[] getAlternatives()
 * @method self setSelectionType(string|null $selectionType)
 * @method string|null getSelectionType()
 */
#[Serializer\XmlRoot('CONFIG_PARTS')]
class Parts implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    /**
     * @var PartAlternative[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Config\PartAlternative>')]
    #[Serializer\XmlList(entry: 'PART_ALTERNATIVE', inline: true)]
    protected array $alternatives;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('PART_SELECTION_TYPE')]
    protected ?string $selectionType = null;

    public function addAlternative(PartAlternative $alternative): self
    {
        $this->alternatives[] = $alternative;
        return $this;
    }
}
