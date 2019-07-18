<?php

declare(strict_types=1);

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Exception\NoReleasesException;
use GuzzleHttp\Psr7\Uri;
use JMS\Serializer\Annotation as Serializer;

/**
 * Represents a project on Drupal.org, such as 'drupal' or 'views'.
 *
 * @Serializer\XmlRoot("project")
 */
class Project {

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
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShortName(): string {
        return $this->shortName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName(string $shortName): void {
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getDcCreator(): string {
        return $this->dcCreator;
    }

    /**
     * @param string $dcCreator
     */
    public function setDcCreator(string $dcCreator): void {
        $this->dcCreator = $dcCreator;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     */
    public function setApiVersion(string $apiVersion): void {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return int
     */
    public function getRecommendedMajor(): int {
        return $this->recommendedMajor;
    }

    /**
     * @param int $recommendedMajor
     */
    public function setRecommendedMajor(int $recommendedMajor): void {
        $this->recommendedMajor = $recommendedMajor;
    }

    /**
     * @return int
     */
    public function getSupportedMajors(): int {
        return $this->supportedMajors;
    }

    /**
     * @param int $supportedMajors
     */
    public function setSupportedMajors(int $supportedMajors): void {
        $this->supportedMajors = $supportedMajors;
    }

    /**
     * @return int
     */
    public function getDefaultMajor(): int {
        return $this->defaultMajor;
    }

    /**
     * @param int $defaultMajor
     */
    public function setDefaultMajor(int $defaultMajor): void {
        $this->defaultMajor = $defaultMajor;
    }

    /**
     * @return string
     */
    public function getProjectStatus(): string {
        return $this->projectStatus;
    }

    /**
     * @param string $projectStatus
     */
    public function setProjectStatus(string $projectStatus): void {
        $this->projectStatus = $projectStatus;
    }

    /**
     * @return \GuzzleHttp\Psr7\Uri
     */
    public function getLink(): Uri {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void {
        $this->link = $link;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Term[]
     */
    public function getTerms(): array {
        return $this->terms;
    }

    /**
     * Return the recommended release for this project.
     *
     * The upstream function for this is tightly coupled to Drupal and has
     * significant logic that isn't documented in the function header (but is in
     * comments in the body). Currently, this method doesn't exactly duplicate
     * the algorithm in Drupal, but a more straight-forward approximation
     * somewhat mirroring typical semver solutions.
     *
     * - 1.6-bugfix <-- recommended version because 1.6 already exists.
     * - 1.6
     *
     * or
     *
     * - 1.6-beta
     * - 1.5 <-- recommended version because no 1.6 exists.
     * - 1.4
     *
     * This function relies on the fact that the .xml release history data comes
     * sorted based on major version and patch level, then finally by release
     * date if there are multiple releases such as betas from the same
     * major.patch version (e.g., 5.x-1.5-beta1, 5.x-1.5-beta2, and 5.x-1.5).
     * Development snapshots for a given major version are always listed last.
     *
     * @see \update_calculate_project_update_status() in Drupal 8.
     */
    public function getRecommendedRelease(): Release {
        $releases = $this->getReleases();
        if (empty($releases)) {
            throw new NoReleasesException($this);
        }

        // By default, the first release in the list is recommended.
        $recommended = $releases[0];

        // Loop through releases as the top release may be a prerelease.
        for ($index = 0; $index < count($releases); $index++) {
            // The current release we are evaluating.
            $release = $releases[$index];

            // If the release does not contain a dash (1.2-beta1), then it must
            // be a full release and can be used.
            if (strpos($release->getVersion(), '-') === FALSE) {
                break;
            }

            // Move to the next release as this release contains a dash.
            if ($index + 1 == count($releases)) {
                break;
            }
            $index++;

            $release = $releases[$index];
            // If the next release does not contain a dash, and it is for a
            // prior stable release, then it becomes recommended.
            if (strpos($release->getVersion(), '-') === FALSE &&
                ($release->getVersionMajor() != $recommended->getVersionMajor() ||
                    $release->getVersionMinor() != $recommended->getVersionMinor() ||
                    $release->getVersionPatch() != $recommended->getVersionPatch())) {
                $recommended = $release;
                // We have a new recommended release, evaluate again.
                continue;
            }
        }

        return $recommended;
    }

    /**
     * @return \Deviantintegral\DrupalUpdateClient\Release[]
     */
    public function getReleases(): array {
        return $this->releases;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Release[] $releases
     *
     * @return \Deviantintegral\DrupalUpdateClient\Project
     */
    public function setReleases(array $releases): self {
        $this->releases = $releases;
        return $this;
    }
}
