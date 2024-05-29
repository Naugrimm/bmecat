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

You are advised to always use the `NodeBuilder::fromArray(...)` to create new nodes instead of `new MyNodeClass`. Use the `\Utils\Rector\Rector\NodeInterfaceConstructorCallToNodeBuilderFromArrayRector:class` to automatically convert all these occurrences.

