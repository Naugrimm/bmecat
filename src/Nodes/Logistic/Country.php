<?php

namespace Naugrim\BMEcat\Nodes\Logistic;

use Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
use Naugrim\BMEcat\Nodes\Concerns\HasStringValue;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<Country>
 */
class Country implements NodeInterface
{
    use HasSerializableAttributes;

    /**
     * @use HasStringValue<self>
     */
    use HasStringValue;

    /**
     * @TODO: validate against iso country codes
     * ISO 3166-1 http://www.iso.org/iso/en/prods-services/iso3166ma/index.html
     */
}
