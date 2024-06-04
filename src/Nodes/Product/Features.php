<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setReferenceFeatureSystemName(string|null $referenceFeatureSystemName)
 * @method string|null getReferenceFeatureSystemName()
 * @method self setReferenceFeatureGroupId(array|null $referenceFeatureGroupId)
 * @method array|null getReferenceFeatureGroupId()
 * @method self setReferenceFeatureGroupName(array|null $referenceFeatureGroupName)
 * @method array|null getReferenceFeatureGroupName()
 * @method self setFeatures(\Naugrim\BMEcat\Nodes\Product\Feature|array $features)
 * @method Naugrim\BMEcat\Nodes\Product\Feature[] getFeatures()
 */
#[Serializer\XmlRoot('PRODUCT_FEATURES')]
class Features implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REFERENCE_FEATURE_SYSTEM_NAME')]
    protected ?string $referenceFeatureSystemName = null;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'REFERENCE_FEATURE_GROUP_ID', inline: true)]
    #[Serializer\SkipWhenEmpty]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getReferenceFeatureGroupName')")]
    protected ?array $referenceFeatureGroupId = null;

    /**
     * @var string[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<string>')]
    #[Serializer\XmlList(entry: 'REFERENCE_FEATURE_GROUP_NAME', inline: true)]
    #[Serializer\SkipWhenEmpty]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getReferenceFeatureGroupId')")]
    protected ?array $referenceFeatureGroupName = null;

    /**
     * @var Feature[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Feature>')]
    #[Serializer\XmlList(entry: 'FEATURE', inline: true)]
    protected array $features = [];

    public function addFeature(Feature $feature): self
    {
        $this->features[] = $feature;
        return $this;
    }

    /**
     * @param string[] $referenceFeatureGroupName
     */
    public function setReferenceFeatureGroupName(array $referenceFeatureGroupName): self
    {
        $this->referenceFeatureGroupId = [];
        $this->referenceFeatureGroupName = $referenceFeatureGroupName;
        return $this;
    }

    /**
     * @param string[] $referenceFeatureGroupId
     */
    public function setReferenceFeatureGroupId(array $referenceFeatureGroupId): self
    {
        $this->referenceFeatureGroupName = [];
        $this->referenceFeatureGroupId = $referenceFeatureGroupId;
        return $this;
    }
}
