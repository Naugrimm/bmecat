<?php

namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setGeneratorInfo(string|null $generatorInfo)
 * @method string|null getGeneratorInfo()
 * @method self setCatalog(array<string, mixed>|\Naugrim\BMEcat\Nodes\Catalog $catalog)
 * @method \Naugrim\BMEcat\Nodes\Catalog getCatalog()
 * @method self setBuyerIdRef(null|array<string, mixed>|\Naugrim\BMEcat\Nodes\BuyerIdRef $buyerIdRef)
 * @method \Naugrim\BMEcat\Nodes\BuyerIdRef|null getBuyerIdRef()
 * @method self setSupplierIdRef(null|array<string, mixed>|\Naugrim\BMEcat\Nodes\SupplierIdRef $supplierIdRef)
 * @method \Naugrim\BMEcat\Nodes\SupplierIdRef|null getSupplierIdRef()
 * @method self setParties(\Naugrim\BMEcat\Nodes\Party[]|array<string, mixed> $parties)
 * @method \Naugrim\BMEcat\Nodes\Party[] getParties()
 */
#[Serializer\XmlRoot('HEADER')]
class Header implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
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

    /**
     * @return $this
     */
    public function addParty(Party $party): static
    {
        $this->parties[] = $party;
        return $this;
    }
}
