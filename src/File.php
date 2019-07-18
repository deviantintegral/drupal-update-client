<?php

namespace Deviantintegral\DrupalUpdateClient;

use GuzzleHttp\Psr7\Uri;
use JMS\Serializer\Annotation as Serializer;

class File
{
    /**
     * @var \GuzzleHttp\Psr7\Uri
     * @Serializer\Type("GuzzleHttp\Psr7\Uri")
     * @Serializer\XmlElement(cdata=false)
     */
    private $url;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $archive_type;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
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

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getUrl(): Uri {
        return $this->url;
    }

    /**
     * @param \GuzzleHttp\Psr7\Uri $url
     *
     * @return File
     */
    public function setUrl(Uri $url): File {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getArchiveType(): string {
        return $this->archive_type;
    }

    /**
     * @param string $archive_type
     *
     * @return File
     */
    public function setArchiveType(string $archive_type): File {
        $this->archive_type = $archive_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getMd5(): string {
        return $this->md5;
    }

    /**
     * @param string $md5
     *
     * @return File
     */
    public function setMd5(string $md5): File {
        $this->md5 = $md5;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return File
     */
    public function setSize(int $size): File {
        $this->size = $size;
        return $this;
    }

    /**
     * @return int
     */
    public function getFiledate(): int {
        return $this->filedate;
    }

    /**
     * @param int $filedate
     *
     * @return File
     */
    public function setFiledate(int $filedate): File {
        $this->filedate = $filedate;
        return $this;
    }
}
