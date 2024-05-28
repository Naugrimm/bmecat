<?php


namespace Naugrim\BMEcat\Nodes\Product;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Exception\InvalidSetterException;
use Naugrim\BMEcat\Exception\UnknownKeyException;
use Naugrim\BMEcat\Nodes\Contracts;

/**
 *
 * @Serializer\XmlRoot("PRODUCT_FEATURES")
 */
class Features implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_SYSTEM_NAME")
     *
     * @var string
     */
    protected $referenceFeatureSystemName;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_GROUP_ID")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Exclude(if="methodResultIsset(object, 'getReferenceFeatureGroupName')")
     *
     * @var string
     */
    protected $referenceFeatureGroupId;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("REFERENCE_FEATURE_GROUP_NAME")
     * @Serializer\SkipWhenEmpty
     * @Serializer\Exclude(if="methodResultIsset(object, 'getReferenceFeatureGroupId')")
     *
     * @var string
     */
    protected $referenceFeatureGroupName;

    /**
     * @Serializer\Expose
     * @Serializer\Type("array<Naugrim\BMEcat\Nodes\Product\Feature>")
     * @Serializer\XmlList( inline = true, entry="FEATURE")
     *
     * @var Feature[]
     */
    protected $features;

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
     * @Serializer\PreSerialize
     * @Serializer\PostSerialize
     * @return Features
     */
    public function nullFeatures() : Features
    {
        if (empty($this->features) === true) {
            $this->features = null;
        }
        return $this;
    }

    /**
     * @param string $referenceFeatureSystemName
     * @return Features
     */
    public function setReferenceFeatureSystemName($referenceFeatureSystemName) : Features
    {
        $this->referenceFeatureSystemName = $referenceFeatureSystemName;
        return $this;
    }

    /**
     * @param string $referenceFeatureGroupName
     * @return Features
     */
    public function setReferenceFeatureGroupName($referenceFeatureGroupName) : Features
    {
        $this->referenceFeatureGroupId = null;
        $this->referenceFeatureGroupName = $referenceFeatureGroupName;
        return $this;
    }

    /**
     * @param string $referenceFeatureGroupId
     * @return Features
     */
    public function setReferenceFeatureGroupId($referenceFeatureGroupId) : Features
    {
        $this->referenceFeatureGroupName = null;
        $this->referenceFeatureGroupId = $referenceFeatureGroupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureSystemName()
    {
        return $this->referenceFeatureSystemName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupName()
    {
        return $this->referenceFeatureGroupName;
    }

    /**
     * @return string
     */
    public function getReferenceFeatureGroupId()
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
