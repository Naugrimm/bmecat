<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;


#[Serializer\XmlRoot('PRODUCT_FEATURES')]
class Features implements Contracts\NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REFERENCE_FEATURE_SYSTEM_NAME')]
    protected string $referenceFeatureSystemName;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REFERENCE_FEATURE_GROUP_ID')]
    #[Serializer\SkipWhenEmpty]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getReferenceFeatureGroupName')")]
    protected string $referenceFeatureGroupId;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('REFERENCE_FEATURE_GROUP_NAME')]
    #[Serializer\SkipWhenEmpty]
    #[Serializer\Exclude(if: "methodResultIsset(object, 'getReferenceFeatureGroupId')")]
    protected string $referenceFeatureGroupName;

    /**
     *
     * @var Feature[]
     */
    #[Serializer\Expose]
    #[Serializer\Type('array<Naugrim\BMEcat\Nodes\Product\Feature>')]
    #[Serializer\XmlList(inline: true, entry: 'FEATURE')]
    protected array $features;

    /**
     * @param Feature[] $features
     * @return Features
     * @throws InvalidSetterException
     * @throws UnknownKeyException
     */
    public function setFeatures(array $features): Features
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (is_array($feature)) {
                $feature = NodeBuilder::fromArray($feature, new Feature());
            }

            $this->addFeature($feature);
        }

        return $this;
    }

    /**
     * @param Feature $feature
     * @return Features
     */
    public function addFeature(Feature $feature) : Features
    {
        if ($this->features === null) {
            $this->features = [];
        }

        $this->features[] = $feature;
        return $this;
    }

    /**
     *
     * @return Features
     */
    #[Serializer\PreSerialize]
    #[Serializer\PostSerialize]
    public function nullFeatures() : Features
    {
        if ($this->features === []) {
            $this->features = null;
        }

        return $this;
    }

    /**
     * @param string $referenceFeatureSystemName
     * @return Features
     */
    public function setReferenceFeatureSystemName(string $referenceFeatureSystemName) : Features
    {
        $this->referenceFeatureSystemName = $referenceFeatureSystemName;
        return $this;
    }

    /**
     * @param string $referenceFeatureGroupName
     * @return Features
     */
    public function setReferenceFeatureGroupName(string $referenceFeatureGroupName) : Features
    {
        $this->referenceFeatureGroupId = null;
        $this->referenceFeatureGroupName = $referenceFeatureGroupName;
        return $this;
    }

    /**
     * @param string $referenceFeatureGroupId
     * @return Features
     */
    public function setReferenceFeatureGroupId(string $referenceFeatureGroupId) : Features
    {
        $this->referenceFeatureGroupName = null;
        $this->referenceFeatureGroupId = $referenceFeatureGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureSystemName(): string
    {
        return $this->referenceFeatureSystemName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupName(): string
    {
        return $this->referenceFeatureGroupName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupId(): string
    {
        return $this->referenceFeatureGroupId;
    }

    /**
     * @return Feature[]
     */
    public function getFeatures()
    {
        if ($this->features === null) {
            return [];
        }

        return $this->features;
    }
}
