<?php

namespace Deviantintegral\DrupalUpdateClient\Exception;

use Deviantintegral\DrupalUpdateClient\Element\Project;

/**
 * Thrown when a project has no matching releases.
 */
class NoMatchingReleasesException extends \RuntimeException
{
    /**
     * NoMatchingReleasesException constructor.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Element\Project $project  The project that has no releases.
     * @param \Throwable|null                                     $previous The previous exception, if one exists.
     */
    public function __construct(Project $project, string $version = '', \Throwable $previous = null)
    {
        if ($version) {
            parent::__construct(sprintf('%s has no releases for version %s', $project->getTitle(), $version), $code = 0, $previous);
        } else {
            parent::__construct(sprintf('%s has no matching releases', $project->getTitle()), $code = 0, $previous);
        }
    }
}
