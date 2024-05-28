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
    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('type')]
    #[Serializer\XmlAttribute]
    protected string $type = "generation_date";

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('DATE')]
    protected string $date;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIME')]
    protected string $time;

    /**
     *
     * @var string
     */
    #[Serializer\Expose]
    #[Serializer\Type('string')]
    #[Serializer\SerializedName('TIMEZONE')]
    protected string $timezone;

    /**
     * @param DateTimeImmutable $dateTime
     * @return DateTime
     */
    public function setDateTime(DateTimeImmutable $dateTime) : DateTime
    {
        $this->setDate($dateTime->format('Y-m-d'));
        $this->setTime($dateTime->format('H:i:s'));
        $this->setTimezone($dateTime->format('P'));
        return $this;
    }

    /**
     * @param string $date
     * @return DateTime
     */
    public function setDate(string $date) : DateTime
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $time
     * @return DateTime
     */
    public function setTime(string $time) : DateTime
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $timezone
     * @return DateTime
     */
    public function setTimezone(string $timezone) : DateTime
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }
}
