<?php

namespace Naugrim\BMEcat\Nodes\Contact;

use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Builder\NodeBuilder;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;
use Naugrim\BMEcat\Nodes\Emails;
use Naugrim\BMEcat\Nodes\Fax;
use Naugrim\BMEcat\Nodes\Phone;

class Details implements NodeInterface
{
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_ID')]
    protected string $id;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_NAME')]
    protected string $name;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('FIRST_NAME')]
    protected string $firstName;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TITLE')]
    protected string $title;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('ACADEMIC_TITLE')]
    protected string $academicTitle;

    /**
     *
     * @var Role
     */
    #[Serializer\Expose]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Contact\Role::class)]
    #[Serializer\SerializedName('CONTACT_ROLE')]
    protected \Naugrim\BMEcat\Nodes\Contact\Role $role;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('CONTACT_DESCRIPTION')]
    protected string $description;
    
    /**
     *
     * @var Phone
     */
    #[Serializer\Expose]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Phone::class)]
    #[Serializer\SerializedName('PHONE')]
    protected \Naugrim\BMEcat\Nodes\Phone $phone;

    /**
     *
     * @var Fax
     */
    #[Serializer\Expose]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Fax::class)]
    #[Serializer\SerializedName('FAX')]
    protected \Naugrim\BMEcat\Nodes\Fax $fax;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('URL')]
    protected string $url;
    
    /**
     *
     * @var Emails
     */
    #[Serializer\Expose]
    #[Serializer\Type(\Naugrim\BMEcat\Nodes\Emails::class)]
    #[Serializer\SerializedName('EMAILS')]
    protected \Naugrim\BMEcat\Nodes\Emails $emails;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Details
     */
    public function setId(string $id): Details
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Details
     */
    public function setName(string $name): Details
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Details
     */
    public function setFirstName(string $firstName): Details
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Details
     */
    public function setTitle(string $title): Details
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getAcademicTitle(): string
    {
        return $this->academicTitle;
    }

    /**
     * @param string $academicTitle
     * @return Details
     */
    public function setAcademicTitle(string $academicTitle): Details
    {
        $this->academicTitle = $academicTitle;
        return $this;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     * @return Details
     */
    public function setRole(Role $role): Details
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Details
     */
    public function setDescription(string $description): Details
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     * @return Details
     */
    public function setPhone(Phone $phone): Details
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return Fax
     */
    public function getFax(): Fax
    {
        return $this->fax;
    }

    /**
     * @param Fax $fax
     * @return Details
     */
    public function setFax(Fax $fax): Details
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return Details
     */
    public function setUrl(string $url): Details
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return Emails
     */
    public function getEmails(): Emails
    {
        return $this->emails;
    }

    /**
     * @param Emails $emails
     * @return Details
     */
    public function setEmails(Emails $emails): Details
    {
        $this->emails = $emails;
        return $this;
    }
}
