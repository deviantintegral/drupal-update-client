<?php

namespace Deviantintegral\DrupalUpdateClient;

use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a single term.
 */
class Term
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $name;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $value;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
