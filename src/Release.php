<?php

namespace Deviantintegral\DrupalUpdateClient;

use JMS\Serializer\Annotation as Serializer;

class Release
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
    private $version;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
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
     * @Serializer\XmlElement(cdata=false)
     */
    private $status;

    /**
     * @var \GuzzleHttp\Psr7\Uri
     * @Serializer\Type("GuzzleHttp\Psr7\Uri")
     */
    private $release_link;

    /**
     * @var \GuzzleHttp\Psr7\Uri
     * @Serializer\Type("GuzzleHttp\Psr7\Uri")
     */
    private $download_link;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $date;

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Release
     */
    public function setName(string $name): Release {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Release
     */
    public function setVersion(string $version): Release {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return Release
     */
    public function setTag(string $tag): Release {
        $this->tag = $tag;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersionMajor(): int {
        return $this->version_major;
    }

    /**
     * @param int $version_major
     *
     * @return Release
     */
    public function setVersionMajor(int $version_major): Release {
        $this->version_major = $version_major;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersionMinor(): int {
        return $this->version_minor;
    }

    /**
     * @param int $version_minor
     *
     * @return Release
     */
    public function setVersionMinor(int $version_minor): Release {
        $this->version_minor = $version_minor;
        return $this;
    }

    /**
     * @return int
     */
    public function getVersionPatch(): int {
        return $this->version_patch;
    }

    /**
     * @param int $version_patch
     *
     * @return Release
     */
    public function setVersionPatch(int $version_patch): Release {
        $this->version_patch = $version_patch;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Release
     */
    public function setStatus(string $status): Release {
        $this->status = $status;
        return $this;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getReleaseLink(): \GuzzleHttp\Psr7\Uri {
        return $this->release_link;
    }

    /**
     * @param \GuzzleHttp\Psr7\Uri $release_link
     *
     * @return Release
     */
    public function setReleaseLink(\GuzzleHttp\Psr7\Uri $release_link): Release {
        $this->release_link = $release_link;
        return $this;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getDownloadLink(): \GuzzleHttp\Psr7\Uri {
        return $this->download_link;
    }

    /**
     * @param \GuzzleHttp\Psr7\Uri $download_link
     *
     * @return Release
     */
    public function setDownloadLink(\GuzzleHttp\Psr7\Uri $download_link): Release {
        $this->download_link = $download_link;
        return $this;
    }

    /**
     * @return string
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * @param string $date
     *
     * @return Release
     */
    public function setDate(string $date): Release {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string
     */
    public function getMdhash(): string {
        return $this->mdhash;
    }

    /**
     * @param string $mdhash
     *
     * @return Release
     */
    public function setMdhash(string $mdhash): Release {
        $this->mdhash = $mdhash;
        return $this;
    }

    /**
     * @return int
     */
    public function getFilesize(): int {
        return $this->filesize;
    }

    /**
     * @param int $filesize
     *
     * @return Release
     */
    public function setFilesize(int $filesize): Release {
        $this->filesize = $filesize;
        return $this;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\File[]
     */
    public function getFiles(): array {
        return $this->files;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\File[] $files
     *
     * @return Release
     */
    public function setFiles(array $files): Release {
        $this->files = $files;
        return $this;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Term[]
     */
    public function getTerms(): array {
        return $this->terms;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Term[] $terms
     *
     * @return Release
     */
    public function setTerms(array $terms): Release {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecurity(): string {
        return $this->security;
    }

    /**
     * @param string $security
     *
     * @return Release
     */
    public function setSecurity(string $security): Release {
        $this->security = $security;
        return $this;
    }

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
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
     * @Serializer\XmlElement(cdata=false)
     */
    private $security;
}
