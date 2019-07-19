<?php

namespace Deviantintegral\DrupalUpdateClient\Exception;

use Deviantintegral\DrupalUpdateClient\Element\Project;

/**
 * Thrown when a project has no releases.
 */
class NoReleasesException extends \RuntimeException
{
    /**
     * NoReleasesException constructor.
     *
     * @param \Deviantintegral\DrupalUpdateClient\Element\Project $project  The project that has no releases.
     * @param \Throwable|null                                     $previous The previous exception, if one exists.
     */
    public function __construct(Project $project, \Throwable $previous = null)
    {
        parent::__construct(sprintf('%s has no releases', $project->getTitle()), $code = 0, $previous);
    }
}
