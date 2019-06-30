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
     */
    private $value;
}
