<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Webmozart\Assert\Assert;
use function PHPStan\dumpType;

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

    /**
     *
     * @var Catalog
     */
    #[Serializer\Expose]
    #[Serializer\Type(Catalog::class)]
    #[Serializer\SerializedName('CATALOG')]
    protected Catalog $catalog;

    /**
     *
     * @var BuyerIdRef
     */
    #[Serializer\Expose]
    #[Serializer\Type(BuyerIdRef::class)]
    #[Serializer\SerializedName('BUYER_IDREF')]
    protected ?BuyerIdRef $buyerIdRef = null;

    /**
     *
     * @var SupplierIdRef
     */
    #[Serializer\Expose]
    #[Serializer\Type(SupplierIdRef::class)]
    #[Serializer\SerializedName('SUPPLIER_IDREF')]
    protected ?SupplierIdRef $supplierIdRef = null;

    /**
     *
     *
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

    /**
     * @param string $generatorInfo
     * @return self
     */
    public function setGeneratorInfo(string $generatorInfo): self
    {
        $this->generatorInfo = $generatorInfo;
        return $this;
    }

    /**
     * @return Catalog
     */
    public function getCatalog(): Catalog
    {
        return $this->catalog;
    }

    /**
     * @param Catalog $catalog
     * @return Header
     */
    public function setCatalog(Catalog $catalog): Header
    {
        $this->catalog = $catalog;
        return $this;
    }

    public function getBuyerIdRef(): ?BuyerIdRef
    {
        return $this->buyerIdRef;
    }

    /**
     * @param BuyerIdRef $buyerIdRef
     * @return Header
     */
    public function setBuyerIdRef(BuyerIdRef $buyerIdRef): Header
    {
        $this->buyerIdRef = $buyerIdRef;
        return $this;
    }

    public function getSupplierIdRef(): ?SupplierIdRef
    {
        return $this->supplierIdRef;
    }

    /**
     * @param SupplierIdRef $supplierIdRef
     * @return Header
     */
    public function setSupplierIdRef(SupplierIdRef $supplierIdRef): Header
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
     * @return Header
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setParties(array $parties): Header
    {
        foreach ($parties as $party) {
            if (!$party instanceof Party) {
                $party = NodeBuilder::fromArray($party, new Party());
            }

            $this->addParty($party);
        }

        return $this;
    }

    /**
     * @param Party $party
     * @return $this
     */
    public function addParty(Party $party): static
    {
        $this->parties[] = $party;
        return $this;
    }
}
