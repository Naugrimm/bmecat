<?php

namespace Naugrim\BMEcat\Nodes\Product\Config;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('CONFIG_PARTS')]
class Parts implements Contracts\NodeInterface
{
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
    protected ?string $selection_type = null;

    /**
     * @param PartAlternative[]|array<string, mixed>[] $alternatives
     * @return $this
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setAlternatives(array $alternatives): self
    {
        $this->alternatives = [];
        foreach ($alternatives as $alternative) {
            if (! $alternative instanceof PartAlternative) {
                $alternative = NodeBuilder::fromArray($alternative, new PartAlternative());
            }

            $this->addAlternative($alternative);
        }

        return $this;
    }

    /**
     * @return PartAlternative[]
     */
    public function getAlternatives(): array
    {
        return $this->alternatives;
    }

    public function setSelectionType(?string $selection_type): self
    {
        $this->selection_type = $selection_type;
        return $this;
    }

    public function getSelectionType(): ?string
    {
        return $this->selection_type;
    }

    private function addAlternative(PartAlternative $alternative): self
    {
        $this->alternatives[] = $alternative;
        return $this;
    }
}
