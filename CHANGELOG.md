# 5.x

## BREAKING CHANGES

Attribute names have been changed to camelCase. See commit 1ef916816b2fe07eaea3c0f64f9b0577e911d011.

## Development

To provide code completion in the IDEs, a new Rector has been added, that adds getter/setter method annotations for all serializable attributes: `\Utils\Rector\Rector\AddDocBlockWithMethodHintsToNodeInterfaceClassesRector`

# 4.x

## BREAKING CHANGES

`\Naugrim\BMEcat\Nodes\Catalog::$language` now correctly is an Element of type `array<\Naugrim\BMEcat\Nodes\Language>` instead of a simple string.

# 3.x

## BREAKING CHANGES

All the simple getter/setter methods have been replaced by a magic `__call` method. In the case that you have implemented the `NodeInterface` by yourselves, you should use the trait `\Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes` in your classes. Manually implemented getters/setters are preferred over the magic method.

As the logic to cast arrays to the correct child nodes has been moved from the `NodeBuilder` into this trait, your manual setters for child elements will most likely break.

Use the rector rule `\Utils\Rector\Rector\NodeInterfaceAddHasSerializableAttributesTraitRector` to automatically include the trait into your classes.

Afterward, you can apply the rector rules `\Utils\Rector\Rector\NodeInterfaceRemoveSimpleGettersRector` and `\Utils\Rector\Rector\NodeInterfaceRemoveSimpleSettersRector` to get rid of the now superfluous methods. This in turn will make PHPStan very unhappy. To counter this, you can register a custom PHPStan extension that uses Reflection to ensure you are using the correct types. Add to your `phpstan.neon`:

```neon
services:
  -
    class: Naugrim\BMEcat\PHPStan\NodeInterfaceMethodsClassReflectionExtension
    tags:
      - phpstan.broker.methodsClassReflectionExtension
```

Then you need to manually search for `public function set\w+\(array` to find setters for array children. If they only iterate the given value to ensure every array item is implementing `NodeInterface`, you can remove them too. But ensure you have type-hinted the elements of the array correctly:

```php
class Product {
    /**
     * @var Features[]
     */
    #[Serializer\Expose]
    // note the FQCN specifying the type of the array items
    #[Serializer\Type('array<\Naugrim\BMEcat\Nodes\Product\Features>')]
    #[Serializer\XmlList(entry: 'PRODUCT_FEATURES', inline: true)]
    protected array $features = [];
    
    // this method is now useless
    public function setFeatures(array $features): self
    {
        $this->features = [];
        foreach ($features as $feature) {
            if (! $feature instanceof Features) {
                $feature = NodeBuilder::fromArray($feature, \Naugrim\BMEcat\Builder\NodeBuilder::fromArray([], Features::class));
            }

            $this->addFeatures($feature);
        }

        return $this;
    }
}
```

# 2.x

## BREAKING CHANGES

This release drops support for PHP < 8.2.

Types are now enforced via PHP. This will break a lot of places where the package did not adhere to the BMECat spec until now.

This includes but is not limited to:

- Product: `DESCRIPTION_SHORT` is required
- Features: `FVALUE` is required
- Features: `REFERENCE_FEATURE_GROUP_ID`/`REFERENCE_FEATURE_GROUP_NAME` must be passed as an array instead of as a string
- Order Details: `ORDER_UNIT` and `CONTENT_UNIT` are required

Nearly all elements that are rendered as lists are not nullable anymore. They are type-hinted as `array` and initialized with an empty array.
Change all your `NodeInterface->setXyz(null)` calls to `NodeInterface->setXyz([])` when you want to clear these lists.

You are advised to always use the `NodeBuilder::fromArray(...)` to create new nodes instead of `new MyNodeClass`. Use the `\Utils\Rector\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector` rule to automatically convert all these occurrences.
