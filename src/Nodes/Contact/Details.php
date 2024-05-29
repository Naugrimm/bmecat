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
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_ID')]
    protected string $id;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_NAME')]
    protected string $name;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FIRST_NAME')]
    protected string $firstName;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TITLE')]
    protected string $title;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ACADEMIC_TITLE')]
    protected string $academicTitle;

    #[Serializer\Expose]
    #[Serializer\Type(Role::class)]
    #[Serializer\SerializedName('CONTACT_ROLE')]
    protected Role $role;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_DESCRIPTION')]
    protected string $description;

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
    protected string $url;

    #[Serializer\Expose]
    #[Serializer\Type(Emails::class)]
    #[Serializer\SerializedName('EMAILS')]
    protected Emails $emails;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getAcademicTitle(): string
    {
        return $this->academicTitle;
    }

    public function setAcademicTitle(string $academicTitle): self
    {
        $this->academicTitle = $academicTitle;
        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }

    public function setPhone(Phone $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    public function getFax(): Fax
    {
        return $this->fax;
    }

    public function setFax(Fax $fax): self
    {
        $this->fax = $fax;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getEmails(): Emails
    {
        return $this->emails;
    }

    public function setEmails(Emails $emails): self
    {
        $this->emails = $emails;
        return $this;
    }
}
