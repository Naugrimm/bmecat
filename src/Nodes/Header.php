<?php


namespace Naugrim\BMEcat\Nodes;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;

/**
 *
 * @Serializer\XmlRoot("HEADER")
 */
class Header implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("GENERATOR_INFO")
     *
     * @var string
     */
    protected $generatorInfo;

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\Catalog")
     * @Serializer\SerializedName("CATALOG")
     *
     * @var Catalog
     */
    protected $catalog;

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\BuyerIdRef")
     * @Serializer\SerializedName("BUYER_IDREF")
     *
     * @var BuyerIdRef
     */
    protected $buyerIdRef;

    /**
     * @Serializer\Expose
     * @Serializer\Type("Naugrim\BMEcat\Nodes\SupplierIdRef")
     * @Serializer\SerializedName("SUPPLIER_IDREF")
     *
     * @var SupplierIdRef
     */
    protected $supplierIdRef;

    /**
     *
     * @Serializer\Expose
     * @Serializer\SerializedName("PARTIES")
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Party>")
     * @Serializer\XmlList(entry = "PARTY")
     *
     * @var Party[]
     */
    protected $parties = [];

    /**
     * @return string|null
     */
    public function getGeneratorInfo()
    {
        return $this->generatorInfo;
    }

    /**
     * @param string $generatorInfo
     * @return Header
     */
    public function setGeneratorInfo(string $generatorInfo): Header
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

    /**
     * @return BuyerIdRef
     */
    public function getBuyerIdRef()
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

    /**
     * @return SupplierIdRef
     */
    public function getSupplierIdRef()
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
     * @param Party[] $parties
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
    public function addParty(Party $party)
    {
        $this->parties[] = $party;
        return $this;
    }
}
