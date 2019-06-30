<?php

namespace Deviantintegral\DrupalUpdateClient;

use JMS\Serializer\Annotation as Serializer;

class Release
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $version;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $tag;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $version_major;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $version_minor;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $version_patch;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $status;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $release_link;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $download_link;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $date;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $mdhash;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $filesize;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\File[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\File>")
     * @Serializer\XmlList(entry="file")
     */
    private $files;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Term[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\Term>")
     * @Serializer\XmlList(entry="term")
     */
    private $terms;

    /**
     * @var string
     * @Serializer\Type("Deviantintegral\DrupalUpdateClient\Security")
     */
    private $security;
}
