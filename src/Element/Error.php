<?php

namespace Deviantintegral\DrupalUpdateClient\Element;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("error")
 */
class Error
{
    /**
     * @var string
     * @Serializer\XmlValue()
     * @Serializer\Type("string")
     */
    protected $message;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return Error
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
