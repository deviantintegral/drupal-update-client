<?php

namespace Deviantintegral\DrupalUpdateClient;

use JMS\Serializer\Annotation as Serializer;

class Security
{
    /**
     * @var bool
     * @Serializer\Type("boolean")
     * @Serializer\XmlAttribute()
     */
    private $covered = false;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlValue()
     * @Serializer\XmlElement(cdata=false)
     */
    private $value;

    /**
     * @return bool
     */
    public function isCovered(): bool
    {
        return $this->covered;
    }

    /**
     * @param bool $covered
     *
     * @return Security
     */
    public function setCovered(bool $covered): self
    {
        $this->covered = $covered;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return Security
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
