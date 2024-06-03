<?php

namespace Naugrim\BMEcat\Nodes\Contact;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Emails;
use Naugrim\BMEcat\Nodes\Fax;
use Naugrim\BMEcat\Nodes\Phone;

/**
 * @implements NodeInterface<self>
 */
class Details implements NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_ID')]
    protected ?string $id = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_NAME')]
    protected string $name;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FIRST_NAME')]
    protected ?string $firstName = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TITLE')]
    protected ?string $title = null;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ACADEMIC_TITLE')]
    protected ?string $academicTitle = null;

    #[Serializer\Expose]
    #[Serializer\Type(Role::class)]
    #[Serializer\SerializedName('CONTACT_ROLE')]
    protected Role $role;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_DESCRIPTION')]
    protected ?string $description = null;

    #[Serializer\Expose]
    #[Serializer\Type(Phone::class)]
    #[Serializer\SerializedName('PHONE')]
    protected Phone $phone;

    #[Serializer\Expose]
    #[Serializer\Type(Fax::class)]
    #[Serializer\SerializedName('FAX')]
    protected Fax $fax;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('URL')]
    protected ?string $url = null;

    #[Serializer\Expose]
    #[Serializer\Type(Emails::class)]
    #[Serializer\SerializedName('EMAILS')]
    protected Emails $emails;
}
