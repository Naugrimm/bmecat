<?php

namespace Naugrim\BMEcat\Nodes;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 * @method self setType(string $type)
 * @method string getType()
 * @method self setDate(string $date)
 * @method string getDate()
 * @method self setTime(string $time)
 * @method string getTime()
 * @method self setTimezone(string $timezone)
 * @method string getTimezone()
 */
#[Serializer\XmlRoot('DATETIME')]
class DateTime implements Contracts\NodeInterface
{
    use \Naugrim\BMEcat\Nodes\Concerns\HasSerializableAttributes;
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('type')]
    #[Serializer\XmlAttribute]
    protected string $type = 'generation_date';

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DATE')]
    protected string $date;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME')]
    protected string $time;

    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIMEZONE')]
    protected string $timezone;

    public function setDateTime(DateTimeImmutable $dateTime): self
    {
        $this->setDate($dateTime->format('Y-m-d'));
        $this->setTime($dateTime->format('H:i:s'));
        $this->setTimezone($dateTime->format('P'));
        return $this;
    }
}
