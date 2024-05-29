<?php

namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('PRODUCT_FEATURES')]
class Features implements Contracts\NodeInterface
{
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

    /**
     * @param Feature[]|array<string, mixed>[] $features
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): self
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (! $feature instanceof Feature) {
                $feature = NodeBuilder::fromArray($feature, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Feature::class));
            }

            $this->addFeature($feature);
        }

        return $this;
    }

    public function addFeature(Feature $feature): self
    {
        $this->features[] = $feature;
        return $this;
    }

    public function setReferenceFeatureSystemName(string $referenceFeatureSystemName): self
    {
        $this->referenceFeatureSystemName = $referenceFeatureSystemName;
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

    public function getReferenceFeatureSystemName(): ?string
    {
        return $this->referenceFeatureSystemName;
    }

    /**
     * @return ?string[]
     */
    public function getReferenceFeatureGroupName(): ?array
    {
        return $this->referenceFeatureGroupName;
    }

    /**
     * @return ?string[]
     */
    public function getReferenceFeatureGroupId(): ?array
    {
        return $this->referenceFeatureGroupId;
    }

    /**
     * @return Feature[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }
}
