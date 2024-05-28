<?php

namespace Naugrim\BMEcat\Nodes;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;
use Naugrim\BMEcat\Nodes\Contracts\NodeInterface;

/**
 * @implements NodeInterface<self>
 */
#[Serializer\XmlRoot('DATETIME')]
class DateTime implements Contracts\NodeInterface
{
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

    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;
        return $this;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTimezone(string $timezone): self
    {
        $this->timezone = $timezone;
        return $this;
    }

    public function getTimezone(): string
    {
        return $this->timezone;
    }
}
