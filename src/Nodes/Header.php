<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('HEADER')]
class Header implements Contracts\NodeInterface
{
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('GENERATOR_INFO')]
    protected ?string $generatorInfo = null;

    #[Serializer\Expose]
    #[Serializer\Type(Catalog::class)]
    #[Serializer\SerializedName('CATALOG')]
    protected Catalog $catalog;

    #[Serializer\Expose]
    #[Serializer\Type(BuyerIdRef::class)]
    #[Serializer\SerializedName('BUYER_IDREF')]
    protected ?BuyerIdRef $buyerIdRef = null;

    #[Serializer\Expose]
    #[Serializer\Type(SupplierIdRef::class)]
    #[Serializer\SerializedName('SUPPLIER_IDREF')]
    protected ?SupplierIdRef $supplierIdRef = null;

    /**
     * @var Party[]
     */
    #[Serializer\Expose]
    #[Serializer\SerializedName('PARTIES')]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Party>')]
    #[Serializer\XmlList(entry: 'PARTY')]
    protected array $parties = [];

    public function getGeneratorInfo(): ?string
    {
        return $this->generatorInfo;
    }

    public function setGeneratorInfo(string $generatorInfo): self
    {
        $this->generatorInfo = $generatorInfo;
        return $this;
    }

    public function getCatalog(): Catalog
    {
        return $this->catalog;
    }

    public function setCatalog(Catalog $catalog): self
    {
        $this->catalog = $catalog;
        return $this;
    }

    public function getBuyerIdRef(): ?BuyerIdRef
    {
        return $this->buyerIdRef;
    }

    public function setBuyerIdRef(BuyerIdRef $buyerIdRef): self
    {
        $this->buyerIdRef = $buyerIdRef;
        return $this;
    }

    public function getSupplierIdRef(): ?SupplierIdRef
    {
        return $this->supplierIdRef;
    }

    public function setSupplierIdRef(SupplierIdRef $supplierIdRef): self
    {
        $this->supplierIdRef = $supplierIdRef;
        return $this;
    }

    /**
     * @return Party[]
     */
    public function getParties(): array
    {
        return $this->parties;
    }

    /**
     * @param Party[]|array<string, mixed>[] $parties
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setParties(array $parties): self
    {
        foreach ($parties as $party) {
            if (! $party instanceof Party) {
                $party = NodeBuilder::fromArray($party, new Party());
            }

            $this->addParty($party);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function addParty(Party $party): static
    {
        $this->parties[] = $party;
        return $this;
    }
}
