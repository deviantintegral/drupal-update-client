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

        // If there's multiple releases, and the top release has a suffix, then
        // it's possible we are evaluating a prerelease and not a patch release.
        if (count($releases) > 1 && $recommended->hasSuffix()) {
            $recommended = $this->recommendReleaseWithSuffix($releases);
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

    /**
     * Recommend a release where the first release has a suffix.
     *
     * This method determines if the suffix is a prerelease or a patch release,
     * and recommends the newest, most stable release.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Release[] $releases
     *   An array of releases.
     *
     * @return \Deviantintegral\DrupalUpdateClient\Release
     */
    private function recommendReleaseWithSuffix(array $releases) {
        $recommended = $releases[0];
        for ($index = 1; $index < count($releases); $index++) {
            $release = $releases[$index];

            // If the current recommended release is a patch release, then
            // select it.
            if ($recommended->isSuffixOfRelease($release)) {
                break;
            }

            // The release does not have a suffix, which means that the
            // currently recommended release is a prerelease.
            if (!$release->hasSuffix() || !$release->isSameNumericVersion($recommended)) {
                // Since dev releases are always sorted to the bottom, we know
                // that if we are crossing major version numbers at this point
                // it is between dev-only releases like 2.x-dev and 1.x-dev, in
                // which case we want the newest dev branch.
                if ($recommended->getVersionMajor() == $release->getVersionMajor()) {
                    $recommended = $release;
                }
            }

            // We found a recommended release without a suffix, so it must be a
            // stable release.
            if (!$recommended->hasSuffix()) {
                break;
            }
        }
        return $recommended;
}
}
