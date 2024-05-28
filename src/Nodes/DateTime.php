<?php


namespace Naugrim\BMEcat\Nodes;

use DateTimeImmutable;
use JMS\Serializer\Annotation as Serializer;

/**
 *
 * @Serializer\XmlRoot("DATETIME")
 */
class DateTime implements Contracts\NodeInterface
{
    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("type")
     * @Serializer\XmlAttribute
     *
     * @var string
     */
    protected $type = "generation_date";

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("DATE")
     *
     * @var string
     */
    protected $date;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIME")
     *
     * @var string
     */
    protected $time;

    /**
     * @Serializer\Expose
     * @Serializer\Type("string")
     * @Serializer\SerializedName("TIMEZONE")
     *
     * @var string
     */
    protected $timezone;

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
    public function setDate($date) : DateTime
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $time
     * @return DateTime
     */
    public function setTime($time) : DateTime
    {
        $this->time = $time;
        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $timezone
     * @return DateTime
     */
    public function setTimezone($timezone) : DateTime
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }
}
