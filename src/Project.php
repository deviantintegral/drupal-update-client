<?php

declare(strict_types=1);

namespace Deviantintegral\DrupalUpdateClient;

/**
 * Represents a project on Drupal.org, such as 'drupal' or 'views'.
 */
class Project
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $shortName;

    /**
     * @var string
     */
    private $dcCreator;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var int
     */
    private $recommendedMajor;

    /**
     * @var int
     */
    private $supportedMajor;

    /**
     * @var int
     */
    private $defaultMajor;

    /**
     * @var string
     */
    private $projectStatus;

    /**
     * @var string
     */
    private $link;

    /**
     * @var \Deviantintegral\DrupalUpdateClient\Terms
     */
    private $terms = [];

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
    public function getSupportedMajor(): int
    {
        return $this->supportedMajor;
    }

    /**
     * @param int $supportedMajor
     */
    public function setSupportedMajor(int $supportedMajor): void
    {
        $this->supportedMajor = $supportedMajor;
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
     * @return string
     */
    public function getLink(): string
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
     * @return \Deviantintegral\DrupalUpdateClient\Terms
     */
    public function getTerms(): Terms
    {
        return $this->terms;
    }

    /**
     * @param \Deviantintegral\DrupalUpdateClient\Terms $terms
     */
    public function setTerms(Terms $terms): void
    {
        $this->terms = $terms;
    }

    //    public function addTerm(Term $term): void {
    //        $this->terms[] = $term;
    //    }
    //
    //    public function removeTerm(Term $term): void {
    //        foreach ($this->terms as $index => $search) {
    //            if ($search === $term) {
    //                unset($this->terms[$index]);
    //            }
    //        }
    //    }
}
