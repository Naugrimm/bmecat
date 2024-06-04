<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
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

    public function setSelectionType(?string $selection_type): self
    {
        $this->selection_type = $selection_type;
        return $this;
    }

    public function getSelectionType(): ?string
    {
        return $this->selection_type;
    }
    protected ?string $selectionType = null;

    public function addAlternative(PartAlternative $alternative): self
    {
        $this->alternatives[] = $alternative;
        return $this;
    }
}
