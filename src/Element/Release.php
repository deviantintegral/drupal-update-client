<?php

namespace Deviantintegral\DrupalUpdateClient\Element;

use GuzzleHttp\Psr7\Uri;
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
     * @var \DateTime
     * @Serializer\Type("DateTime")
     * @Serializer\XmlElement(cdata=false)
     */
    private $date;

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
     * @var \Deviantintegral\DrupalUpdateClient\Element\File[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\Element\File>")
     * @Serializer\XmlList(entry="file")
     */
    private $files;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Element\Term[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\Element\Term>")
     * @Serializer\XmlList(entry="term")
     */
    private $terms;

    /**
     * @var string
     * @Serializer\Type("Deviantintegral\DrupalUpdateClient\Element\Security")
     * @Serializer\XmlElement(cdata=false)
     */
    private $security;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Release
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return Release
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return Release
     */
    public function setTag(string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Release
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getReleaseLink(): Uri
    {
        return $this->release_link;
    }

    /**
     * @param \GuzzleHttp\Psr7\Uri $release_link
     *
     * @return Release
     */
    public function setReleaseLink(Uri $release_link): self
    {
        $this->release_link = $release_link;

        return $this;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getDownloadLink(): Uri
    {
        return $this->download_link;
    }

    /**
     * @param \GuzzleHttp\Psr7\Uri $download_link
     *
     * @return Release
     */
    public function setDownloadLink(Uri $download_link): self
    {
        $this->download_link = $download_link;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return Release
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return string
     */
    public function getMdhash(): string
    {
        return $this->mdhash;
    }

    /**
     * @param string $mdhash
     *
     * @return Release
     */
    public function setMdhash(string $mdhash): self
    {
        $this->mdhash = $mdhash;

        return $this;
    }

    /**
     * @return int
     */
    public function getFilesize(): int
    {
        return $this->filesize;
    }

    /**
     * @param int $filesize
     *
     * @return Release
     */
    public function setFilesize(int $filesize): self
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Element\File[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Element\File[] $files
     *
     * @return Release
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;

        return $this;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Element\Term[]
     */
    public function getTerms(): array
    {
        return $this->terms;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Element\Term[] $terms
     *
     * @return Release
     */
    public function setTerms(array $terms): self
    {
        $this->terms = $terms;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecurity(): string
    {
        return $this->security;
    }

    /**
     * @param string $security
     *
     * @return Release
     */
    public function setSecurity(string $security): self
    {
        $this->security = $security;

        return $this;
    }

    /**
     * Returns if this is the same as another release, ignoring suffixes.
     *
     * For example, 8.7.3-beta1 == 8.7.3, while 8.7.3 != 8.7.2.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Element\Release $other The release to compare against.
     *
     * @return bool
     *              True if the other release is the same numeric version, false otherwise.
     */
    public function isSameNumericVersion(self $other): bool
    {
        return $this->getVersionMajor() == $other->getVersionMajor() &&
            $this->getVersionMinor() == $other->getVersionMinor() &&
            $this->getVersionPatch() == $other->getVersionPatch();
    }

    /**
     * Return if this release has a suffix, such as -beta1.
     *
     * @return bool
     */
    public function hasSuffix(): bool
    {
        return false !== strpos($this->getVersion(), '-');
    }

    /**
     * Return if this release is a suffix of another release.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Element\Release $other The other release which must not have a suffix.
     *
     * @return bool
     */
    public function isSuffixOfRelease(self $other): bool
    {
        return $this->hasSuffix() && !$other->hasSuffix() && $this->isSameNumericVersion($other);
    }

    /**
     * @return int
     */
    public function getVersionMajor(): int
    {
        return $this->version_major;
    }

    /**
     * @param int $version_major
     *
     * @return Release
     */
    public function setVersionMajor(int $version_major): self
    {
        $this->version_major = $version_major;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersionMinor(): ?int
    {
        return $this->version_minor;
    }

    /**
     * @param int $version_minor
     *
     * @return Release
     */
    public function setVersionMinor(int $version_minor): self
    {
        $this->version_minor = $version_minor;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVersionPatch(): ?int
    {
        return $this->version_patch;
    }

    /**
     * @param int $version_patch
     *
     * @return Release
     */
    public function setVersionPatch(int $version_patch): self
    {
        $this->version_patch = $version_patch;

        return $this;
    }
}
