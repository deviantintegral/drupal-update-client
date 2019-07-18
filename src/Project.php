<?php

declare(strict_types=1);

namespace Deviantintegral\DrupalUpdateClient;

use GuzzleHttp\Psr7\Uri;
use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a project on Drupal.org, such as 'drupal' or 'views'.
 *
 * @Serializer\XmlRoot("project")
 */
class Project
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $title;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $shortName;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("dc:creator")
     * @Serializer\XmlElement(cdata=false)
     */
    private $dcCreator;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $type;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $apiVersion;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $recommendedMajor;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $supportedMajors;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    private $defaultMajor;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\XmlElement(cdata=false)
     */
    private $projectStatus;

    /**
     * @var \GuzzleHttp\Psr7\Uri
     * @Serializer\Type("GuzzleHttp\Psr7\Uri")
     */
    private $link;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Term[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\Term>")
     * @Serializer\XmlList(entry="term")
     */
    private $terms = [];

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Release[]
     * @Serializer\Type("array<Deviantintegral\DrupalUpdateClient\Release>")
     * @Serializer\XmlList(entry="release")
     */
    private $releases;

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Release[]
     */
    public function getReleases(): array
    {
        return $this->releases;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Release[] $releases
     */
    public function setReleases(array $releases): void
    {
        $this->releases = $releases;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName): void
    {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getDcCreator(): string
    {
        return $this->dcCreator;
    }

    /**
     * @param string $dcCreator
     */
    public function setDcCreator(string $dcCreator): void
    {
        $this->dcCreator = $dcCreator;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     */
    public function setApiVersion(string $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return int
     */
    public function getRecommendedMajor(): int
    {
        return $this->recommendedMajor;
    }

    /**
     * @param int $recommendedMajor
     */
    public function setRecommendedMajor(int $recommendedMajor): void
    {
        $this->recommendedMajor = $recommendedMajor;
    }

    /**
     * @return int
     */
    public function getSupportedMajors(): int
    {
        return $this->supportedMajors;
    }

    /**
     * @param int $supportedMajors
     */
    public function setSupportedMajors(int $supportedMajors): void
    {
        $this->supportedMajors = $supportedMajors;
    }

    /**
     * @return int
     */
    public function getDefaultMajor(): int
    {
        return $this->defaultMajor;
    }

    /**
     * @param int $defaultMajor
     */
    public function setDefaultMajor(int $defaultMajor): void
    {
        $this->defaultMajor = $defaultMajor;
    }

    /**
     * @return string
     */
    public function getProjectStatus(): string
    {
        return $this->projectStatus;
    }

    /**
     * @param string $projectStatus
     */
    public function setProjectStatus(string $projectStatus): void
    {
        $this->projectStatus = $projectStatus;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getLink(): Uri
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Term[]
     */
    public function getTerms(): array
    {
        return $this->terms;
    }

}
