<?php

namespace Naugrim\BMEcat\Nodes\Contact;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Emails;
use Naugrim\BMEcat\Nodes\Fax;
use Naugrim\BMEcat\Nodes\Phone;

/**
 * @implements NodeInterface<self>
 * @method self setId(string|null $id)
 * @method string|null getId()
 * @method self setName(string $name)
 * @method string getName()
 * @method self setFirstName(string|null $firstName)
 * @method string|null getFirstName()
 * @method self setTitle(string|null $title)
 * @method string|null getTitle()
 * @method self setAcademicTitle(string|null $academicTitle)
 * @method string|null getAcademicTitle()
 * @method self setRole(array<string, mixed>|\Naugrim\BMEcat\Nodes\Contact\Role $role)
 * @method \Naugrim\BMEcat\Nodes\Contact\Role getRole()
 * @method self setDescription(string|null $description)
 * @method string|null getDescription()
 * @method self setPhone(array<string, mixed>|\Naugrim\BMEcat\Nodes\Phone $phone)
 * @method \Naugrim\BMEcat\Nodes\Phone getPhone()
 * @method self setFax(array<string, mixed>|\Naugrim\BMEcat\Nodes\Fax $fax)
 * @method \Naugrim\BMEcat\Nodes\Fax getFax()
 * @method self setUrl(string|null $url)
 * @method string|null getUrl()
 * @method self setEmails(array<string, mixed>|\Naugrim\BMEcat\Nodes\Emails $emails)
 * @method \Naugrim\BMEcat\Nodes\Emails getEmails()
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
