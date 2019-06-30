<?php

namespace Deviantintegral\DrupalUpdateClient;

use JMS\Serializer\Annotation as Serializer;

class File
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $url;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $archive_type;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $md5;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $size;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $filedate;
}
